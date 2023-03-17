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
        Schema::table('despesas', function (Blueprint $table) {
            $table->foreign('id_usuario', 'fk_despesa_id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('despesas', function (Blueprint $table) {
          $table->dropForeign('fk_despesa_id_usuario');
        });
    }
};
