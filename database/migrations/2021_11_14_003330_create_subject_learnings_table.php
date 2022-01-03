<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * 'user_id',
        'title',
        'description',
        'video',
        'link_streaming',
        'audio',
        'view',
     * @return void
     */
    public function up()
    {
        Schema::create('subject_learnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('video')->nullable();
            $table->string('materi_untuk')->nullable();
            $table->string('cover_materi')->nullable();
            $table->string('link_streaming')->nullable();
            $table->string('audio')->nullable();
            $table->bigInteger('view')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::table('subject_learnings', function (Blueprint $table) {
            $table->dropForeign('subject_learnings_user_id_foreign');
        });
        Schema::dropIfExists('subject_learnings');
    }
}
