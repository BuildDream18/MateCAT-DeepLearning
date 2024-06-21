<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ai_translations', function (Blueprint $table) {
            $table->id();
            $table->text('hash');
            $table->integer('mtmodel_id');
            $table->text('project_name');
            $table->text('source_lang');
            $table->text('target_lang');
            $table->text('email');
            $table->json('files');
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
        Schema::dropIfExists('ai_translations');
    }
}
