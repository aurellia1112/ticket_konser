<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Events;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Events::all();
        return view('customer.index', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'items'          => 'required|array',
            'items.*'        => 'nullable|integer|min:0',
        ]);

        $orderedItems = array_filter((array) $request->items, fn ($qty) => (int) $qty > 0);

        if (empty($orderedItems)) {
            return back()->with('error', 'Pilihlah minimal 1 ticket konser!');
        }

        DB::beginTransaction();

        try {
            $orders = Orders::create([
                'customer_name'  => $request->customer_name,
                'customer_email' => $request->customer_email,
                'total_price'    => 0,
                'status'         => 'Pending',
            ]);

            $ticketPrice = 0;

            foreach ($orderedItems as $eventId => $quantity) {
                $event = Events::findOrFail($eventId);
                $unitPrice = (int) ($event->price ?? 0);
                $subtotal = $unitPrice * (int) $quantity;
                $ticketPrice += $subtotal;

                OrderDetails::create([
                    'order_id' => $orders->id,
                    'event_id' => $event->id,
                    'quantity' => (int) $quantity,
                    'subtotal' => $subtotal,
                ]);
            }

            $orders->update(['total_price' => $ticketPrice]);
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Pemesanan ticket berhasil dibuat! ' . $orders->customer_email);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Gagal memproses pemesanan ticket! ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function adminDashboard()
    {
        $orders = Orders::with('orderDetails.event')->get();
        return view('dashboard', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $orders = Orders::findOrFail($id);
        $orders->update(['status' => $request->status]);

        return back()->with('success', 'Status pemesanan berhasil diperbarui!');
    }
}