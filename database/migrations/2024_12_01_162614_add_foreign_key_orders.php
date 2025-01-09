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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('freelancer_id', 'fk_order_freelancer_to_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id', 'fk_order_client_to_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id', 'fk_order_service_to_services')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('status_order_id', 'fk_order_to_status')->references('id')->on('status_order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('fk_order_freelancer_to_users');
            $table->dropForeign('fk_order_client_to_users');
            $table->dropForeign('fk_order_service_to_services');
            $table->dropForeign('fk_order_to_status');
        });
    }
};
