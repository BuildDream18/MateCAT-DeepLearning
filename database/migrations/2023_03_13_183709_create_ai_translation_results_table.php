<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiTranslationResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ai_translation_results', function (Blueprint $table) {
            $table->id();
            $table->integer('ai_translation_id');
            $table->text('file')->nullable();
            $table->string('provider');
            $table->enum('status',['waiting','success','error']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ai_translation_results');
    }
}
