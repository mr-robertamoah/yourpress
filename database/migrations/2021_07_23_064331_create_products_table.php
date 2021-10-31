<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->nullableMorphs('addedby');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->string('name');
            $table->enum('type', ['ENVELOPE', 'PAPER_BAG']);
            $table->text('description')->nullable();
            $table->boolean('public')->default(false);
            $table->json('uses');
            $table->softDeletes();
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
