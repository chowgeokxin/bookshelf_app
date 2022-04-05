<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookshelvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookshelves', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->constrained('users');
            $table->string('title',100);
            $table->text('description')->nullable();
            $table->boolean('is_read')->default(0);
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
        Schema::table("bookshelves", function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('bookshelves');
    }
}
