<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {

            // Identifiers
            $table->primary('id')->unique(); // SHA1(setCode, cardName, cardImageName)
            $table->string('setCode', 5);
            $table->string('name');
            $table->string('number', 5);
            $table->string('multiverseID');
            $table->string('imageName');
            $table->string('mciNumber');

            /* JSON -Fields:
             * layout, names, colors, colorIdentity, supertypes, types,
             * subtypes, variations, hand, life, reserved, releaseDate, starter,
             * loyalty, watermark, border
             */
            $table->json('meta');


            // Card Values
            $table->string('manaCost');
            $table->string('convertedManaCost');
            $table->string('type');
            $table->string('rarity');
            $table->string('text');
            $table->string('flavor');
            $table->string('artist');
            $table->string('power');
            $table->string('toughness');
            $table->string('timeshifted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }

    private function insertJsonSetFileToCards()
    {

    }
}
