<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lends', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('owner_user_id')->unsigned(); //biblotecario
            $table->bigInteger('customer_user_id')->unsigned(); // cliente
            $table->bigInteger('book_id')->unsigned(); //libro prestado
            $table->date('date_out');
            $table->date('date_in');
            $table->enum('status', ['lend', 'returned']);
            $table->timestamps();
            $table->softDeletes();

            //relaciones a tablas 

            $table->foreign('owner_user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('customer_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('book_id')
                ->references('id')
                ->on('books')
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
        Schema::dropIfExists('lends');
    }
};
