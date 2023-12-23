<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZaposlenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zaposlenis', function (Blueprint $table) {
            $table->id();
            $table->string('pozicija')->nullable();
            $table->string('odeljenje')->nullable();
            $table->date('datum_pocetka_rada')->nullable();
            $table->date('datum_kraja_ugovora')->nullable();
            $table->decimal('plata', 8, 2)->nullable();
            $table->foreignId('firma_id')->nullable()->constrained('firmas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zaposlenis');
    }
}
