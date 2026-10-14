<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'tittle')) {
                $table->renameColumn('tittle', 'name');
            }

            if (Schema::hasColumn('events', 'ticket_price')) {
                $table->renameColumn('ticket_price', 'price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'name')) {
                $table->renameColumn('name', 'tittle');
            }

            if (Schema::hasColumn('events', 'price')) {
                $table->renameColumn('price', 'ticket_price');
            }
        });
    }
};
