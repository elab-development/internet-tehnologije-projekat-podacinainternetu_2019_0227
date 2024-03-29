<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           
            $table->string('pozicija')->nullable();
            $table->string('odeljenje')->nullable();
            $table->date('datum_pocetka_rada')->nullable();
            $table->date('datum_kraja_ugovora')->nullable();
            $table->decimal('plata', 8, 2)->nullable();

            $table->unsignedBigInteger('firma_id')->nullable(); 
            $table->foreign('firma_id')->references('id')->on('firmas')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('pozicija');
            $table->removeColumn('odeljenje');
            $table->removeColumn('datum_pocetka_rada');
            $table->removeColumn('datum_kraja_ugovora');
            $table->removeColumn('datum_kraja_ugovora');
            $table->removeColumn('plata');
            $table->dropForeign(['firma_id']);
            $table->removeColumn('firma_id');

            
            
        });
        
    }
}
