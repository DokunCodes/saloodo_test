<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name',150);
            $table->text('description')->nullable();;
            $table->string('product',200);
            $table->float('price');
            $table->boolean('status');
            $table->string('created_by',200);
            $table->string('updated_by',200)->nullable();
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
        Schema::dropIfExists('bundle');
    }
}
