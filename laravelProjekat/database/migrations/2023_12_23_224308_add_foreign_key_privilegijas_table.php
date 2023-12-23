<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyPrivilegijasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('privilegijas', function (Blueprint $table) {
            
            $table->foreignId('zaposleni_id')->constrained('users');
            $table->foreignId('fajl_id')->constrained('fajls');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('privilegijas', function (Blueprint $table) {
            
            $table->dropForeign([ 'zaposleni_id']);
            $table->removeColumn('zaposleni_id');
            $table->dropForeign([ 'fajl_id']);
            $table->removeColumn('fajl_id');
           
          
        });
    }
}
