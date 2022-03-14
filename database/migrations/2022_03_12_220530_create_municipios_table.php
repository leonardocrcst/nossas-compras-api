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
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("disabled_at")->nullable(true)->default(null);
            $table->string("nome", 75)->nullable(false)->comment($this->nome());
            $table->char("estado", 2)->nullable(false)->comment($this->estado());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
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

    private function estado(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "UF";
        $comment->formCaption = "Estado";
        $comment->description = "Forneça um nome para a lista, como \"compras do mês\", \"hortifruti\", etc.";
        $comment->mask = null;
        $comment->success = null;
        $comment->error = null;
        return $comment;
    }
};
