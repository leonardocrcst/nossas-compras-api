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
        Schema::create('estabelecimentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("disabled_at")->nullable(true)->default(null);
            $table->bigInteger("username", false, true)->nullable(false);
            $table->string("nome", 150)->nullable(false)->comment($this->nome());
            $table->text("endereco")->nullable(true)->comment($this->endereco());
            $table->string("telefone", 16)->nullable(true)->comment($this->telefone());
            $table->string("website", 150)->nullable(true)->comment($this->website());
            $table->decimal("latitude", 7, 5)->nullable(true)->comment($this->latitude());
            $table->decimal("longitude", 7, 5)->nullable(true)->comment($this->longitude());
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
        Schema::dropIfExists('estabelecimentos');
    }

    private function nome(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Nome";
        $comment->formCaption = "Nome do estabelecimento";
        $comment->description = "Nome pelo qual o estabelecimento é reconhecido.";
        return $comment;
    }

    private function endereco(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Endereço";
        $comment->formCaption = "Endereço físico";
        $comment->description = "Rua, número e bairro do estabelecimento.";
        return $comment;
    }

    private function telefone(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Telefone";
        $comment->formCaption = "Telefone (fixo ou móvel)";
        $comment->description = "Telefone para contato, com DDD.";
        $comment->mask = "(00) 0000-0000";
        return $comment;
    }

    private function website(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Site";
        $comment->formCaption = "Endereço na web";
        $comment->description = "Endereço do estabelecimento na rede mundial de computadores.";
        $comment->mask = "(00) 0000-0000";
        return $comment;
    }

    private function latitude(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Site";
        $comment->formCaption = "Endereço na web";
        $comment->description = "Endereço do estabelecimento na rede mundial de computadores.";
        $comment->mask = "(00) 0000-0000";
        return $comment;
    }

    private function longitude(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Site";
        $comment->formCaption = "Endereço na web";
        $comment->description = "Endereço do estabelecimento na rede mundial de computadores.";
        $comment->mask = "(00) 0000-0000";
        return $comment;
    }
};
