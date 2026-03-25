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
        if (!Schema::hasTable('topping')) {
            Schema::create('topping', function (Blueprint $table) {
                $table->id('id_topping');
                $table->string('kode_topping')->unique();
                $table->string('nama_topping');
                $table->decimal('harga_topping', 15, 2);
                $table->string('foto')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topping');
    }
};
