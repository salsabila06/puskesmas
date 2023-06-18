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
        Schema::create('t_cluster', function (Blueprint $table) {
            $table->id('id_cluster');
            $table->bigInteger('cluster_type_id');
            $table->bigInteger('faskes_id');
            $table->bigInteger('survey_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_cluster');
    }
};
