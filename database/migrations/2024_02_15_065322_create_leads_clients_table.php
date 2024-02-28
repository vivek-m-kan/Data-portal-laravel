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
        Schema::create('leads_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('leads_id')->nullable()->references('uuid')->on('leads')->onDelete(null);
            $table->foreignUuid('clients_id')->nullable()->references('uuid')->on('clients')->onDelete(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_clients');
    }
};
