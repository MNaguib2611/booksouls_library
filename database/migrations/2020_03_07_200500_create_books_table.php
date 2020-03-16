<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->string('author', 50);
            $table->unsignedMediumInteger('quantity'); # max value is 16,777,215
            $table->unsignedSmallInteger('price'); # max value is 65,535
            $table->float('rate', 2, 1)->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('cover')->nullable();
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
        Schema::dropIfExists('books');
    }
}
