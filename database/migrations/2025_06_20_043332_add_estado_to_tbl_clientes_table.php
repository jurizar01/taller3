<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tbl_clientes', function (Blueprint $table) {
            $table->boolean('estado')->default(true);
        });
    }

    public function down()
    {
        Schema::table('tbl_clientes', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
