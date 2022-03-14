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
        Schema::create('listas_membros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp("disabled_at")->nullable(true)->default(null);
            $table->bigInteger("familia", false, true)->nullable(false);
            $table->bigInteger("adicionado_por", false, true)->nullable(false);
            $table->bigInteger("desativado_por", false, true)->nullable(false);
            $table->bigInteger("username", false, true)->nullable(false)->comment($this->membro());
            $table->set("permissoes", ["Família", "Listas", "Produtos", "Preços"])->nullable(false)->comment($this->permissoes());
            $table->foreign("familia")->references("id")->on("familias");
            $table->foreign("adicionado_por")->references("id")->on("usuarios");
            $table->foreign("desativado_por")->references("id")->on("usuarios");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listas_membros');
    }

    private function permissoes(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Permissões";
        $comment->formCaption = "Permissões do usuário";
        $comment->description = null;
        $comment->mask = null;
        $comment->success = null;
        $comment->error = null;
        return $comment;
    }

    private function membro(): ColumnComment
    {
        $comment = new ColumnComment();
        $comment->tableCaption = "Membro";
        $comment->formCaption = "Membro da família";
        $comment->description = null;
        $comment->mask = null;
        $comment->success = null;
        $comment->error = null;
        return $comment;
    }
};
