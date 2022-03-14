<?php

include_once "database/tools/ColumnComment.php";

use database\tools\ColumnComment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("disabled_at")->nullable(true)->default(null);
            $table->bigInteger("username", false, true)->nullable(false);
            $table->string("nome", 150)->nullable(false)->comment($this->nome());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('familias');
    }

    private function nome(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Nome";
        $comment->formCaption = "Nome da família";
        $comment->description = null;
        $comment->mask = null;
        $comment->success = null;
        $comment->error = null;
        return $comment;
    }
};
