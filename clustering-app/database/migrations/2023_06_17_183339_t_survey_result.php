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
        Schema::create('t_survey_result', function (Blueprint $table) {
            $table->id('id_survey_result');
            $table->bigInteger('survey_id');
            $table->bigInteger('faskes_id');
            $table->bigInteger('quest_id');
            $table->string('value_real');
            $table->string('value_percentage');
            $table->string('quest_count');
            $table->timestamps();
            $table->bigInteger('created_by'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_survey_result');
    }
};
