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
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('name');
            $table->string('company_name');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('postal_code');
            $table->string('contact_number', 20);
            $table->tinyInteger('is_verified');
            $table->foreignUuid('verified_by')->nullable()->references('uuid')->on('users')->onDelete(null);
            $table->enum('status', ['active', 'inactive', 'hold']);
            $table->foreignUuid('created_by')->nullable()->references('uuid')->on('users')->onDelete(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
