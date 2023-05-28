<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookPublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_publishers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id')->unsigned();
            $table->unsignedBigInteger('publisher_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('cascade');
            $table->foreign('publisher_id')->references('id')->on('publishers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_publishers');
    }
}
