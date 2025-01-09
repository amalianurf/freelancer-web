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
        Schema::table('tagline', function (Blueprint $table) {
            $table->foreign('service_id', 'fk_tagline_to_services')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tagline', function (Blueprint $table) {
            $table->dropForeign('fk_tagline_to_services');
        });
    }
};
