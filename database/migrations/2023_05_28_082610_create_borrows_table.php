<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string("borrow_id");
            $table->unsignedBigInteger('book_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->enum('status', ["BORROW", "RETURN"]);
            $table->date('borrow_date');
            $table->date('return_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('borrows');
    }
}
