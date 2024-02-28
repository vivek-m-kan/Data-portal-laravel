<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('campaigns_id')->nullable()->references('uuid')->on('campaigns')->onDelete(null);
            $table->json('details');
            $table->string('email');
            $table->enum('status', [0, 1, 2, 3, 4])->comment("0=ready-to-send, 1=sent-to-client, 2=waiting-line, 3=declined, 4=duplicated");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
