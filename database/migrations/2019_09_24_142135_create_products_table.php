<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('sku', 20)->unique()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['Publicado', 'Inactivo', 'Eliminado'])->default('Publicado');
            $table->bigInteger('principal_image')->unsigned()->nullable();
            $table->integer('stock')->default(0)->nullable();
            $table->decimal('sale_price')->default(0)->nullable();
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
        Schema::dropIfExists('products');
    }
}
