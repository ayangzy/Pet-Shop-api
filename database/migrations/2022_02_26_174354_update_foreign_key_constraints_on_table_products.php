<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyConstraintsOnTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'category_uuid')) {
                $table->dropForeign('products_category_uuid_foreign');
                $table->foreign('category_uuid')->references('uuid')->on('categories')->onDelete('cascade');
            };  
        });
    }

}
