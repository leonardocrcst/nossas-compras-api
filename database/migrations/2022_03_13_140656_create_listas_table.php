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
        Schema::create('listas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("disabled_at")->nullable(true)->default(null);
            $table->bigInteger("username", false, true)->nullable(false);
            $table->bigInteger("familia", false, true)->nullable(false);
            $table->string("nome", 75)->nullable(false)->comment($this->nome());
            $table->foreign("familia")->references("id")->on("familias");
            $table->foreign("username")->references("id")->on("usuarios");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listas');
    }

    private function nome(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Nome";
        $comment->formCaption = "Nome da lista";
        $comment->description = "Forneça um nome para a lista, como \"compras do mês\", \"hortifruti\", etc.";
        $comment->mask = null;
        $comment->success = null;
        $comment->error = null;
        return $comment;
    }
};
