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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->text("name");
            $table->text("email");
            $table->text("address");
            $table->unsignedInteger("postal");
            $table->integer("product_id");
            $table->enum("size", ["XS", "S", "M", "L", "XL", "XXL"]);
            $table->integer("status")->default(0);
            $table->string("notes")->nullable();
            $table->string("unique_identifier");
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
        Schema::dropIfExists('requests');
    }
};
