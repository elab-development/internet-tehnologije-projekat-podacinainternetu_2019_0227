<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsZaposlenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('firmas', function (Blueprint $table) {
           
            $table->renameColumn('address','adresa');  
            $table->renameColumn('phone','kontaktTelefon');  
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('firmas', function (Blueprint $table) {
           
            $table->renameColumn('adresa','address');  
            $table->renameColumn('kontaktTelefon','phone');  
           
        });
    }
}
