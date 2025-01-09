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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->nullable()->index('fk_order_freelancer_to_users');
            $table->foreignId('client_id')->nullable()->index('fk_order_client_to_users');
            $table->foreignId('service_id')->nullable()->index('fk_order_service_to_services');
            $table->longText('file')->nullable();
            $table->longText('note')->nullable();
            $table->date('expired')->nullable();
            $table->foreignId('status_order_id')->nullable()->index('fk_order_to_status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
