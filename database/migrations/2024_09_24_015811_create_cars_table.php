<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['available', 'sold', 'pending']);
            $table->text('description')->nullable();
            
            // Kolom untuk menyimpan gambar berdasarkan view
            $table->string('front_view_image')->nullable();
            $table->string('back_view_image')->nullable();
            $table->string('left_view_image')->nullable(); 
            $table->string('right_view_image')->nullable();
            $table->string('interior_view_image')->nullable();
            $table->timestamps();
        });
    }   

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
