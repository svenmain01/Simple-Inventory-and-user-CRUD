<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Individual_Items', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('item');            
            $table->string('description');
            $table->string('quantification');
            $table->integer('quantity');
            $table->decimal('priceperquantification');
            $table->decimal('totalprice');
            $table->date('acquisitiondate');
            $table->string('propertynumber')->unique();
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
        Schema::dropIfExists('Individual_Items');
    }
}
