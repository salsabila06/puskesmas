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
        Schema::create('t_faskes', function (Blueprint $table) {
            $table->id('id_faskes');
            $table->string('faskes_name');
            $table->string('faskes_code', 10);
            $table->bigInteger('faskes_type_id');
            $table->string('faskes_establish');
            $table->bigInteger('district_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_faskes');
    }
};
