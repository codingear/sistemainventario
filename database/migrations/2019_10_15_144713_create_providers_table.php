<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->string('contact_name', 60);
            $table->string('email')->unique();
            $table->string('rfc', 13);
            $table->text('address');
            $table->string('zip_code', 8);
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->string('city', 60);
            $table->string('telephone', 13);
            $table->string('website', 60)->nullable();
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('providers');
    }
}
