<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicheVTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_v_t_s', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->string('adresse')->nullable();
            $table->string('npa')->nullable();
            $table->date('date_construction')->nullable();
            $table->string('nbre_panneaux')->nullable();
            $table->string('puissance')->nullable();
            $table->string('marque')->nullable();
            $table->string('type_onduleur')->nullable();
            $table->string('batteries')->nullable();
            $table->string('commentaire')->nullable();
            $table->date('rdv_vt')->nullable();
            $table->date('rdv_rbe')->nullable();
            $table->unsignedBigInteger('client_id');
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
        Schema::dropIfExists('fiche_v_t_s');
    }
}
