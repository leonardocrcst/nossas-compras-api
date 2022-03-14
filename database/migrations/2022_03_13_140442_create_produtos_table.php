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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("disabled_at")->nullable(true)->default(null);
            $table->bigInteger("username", false, true)->nullable(false);
            $table->string("codigo_barras")->nullable(true)->default(null)->comment($this->codigo_barras());
            $table->string("nome")->nullable(false)->comment($this->descricao());
            $table->bigInteger("unidade_medida", false, true)->nullable(false)->comment($this->unidade_medida());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }

    private function codigo_barras(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = null;
        $comment->formCaption = "Código de barras";
        $comment->description = "Forneça o código de barras para facilitar a movimentação no estoque.";
        $comment->mask = null;
        $comment->success = null;
        $comment->error = null;
        return $comment;
    }

    private function descricao(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Produto";
        $comment->formCaption = "Descrição do produto";
        $comment->description = "Nome pelo qual o produto é conhecido.";
        $comment->mask = null;
        $comment->success = null;
        $comment->error = null;
        return $comment;
    }

    private function unidade_medida(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Un. medida";
        $comment->formCaption = "Un. medida";
        $comment->description = "Unidade de medida.";
        $comment->mask = null;
        $comment->success = null;
        $comment->error = null;
        return $comment;
    }
};
