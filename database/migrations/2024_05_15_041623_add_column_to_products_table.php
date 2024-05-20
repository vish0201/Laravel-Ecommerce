<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('cat_id');

            // Add foreign key constraint
            $table->foreign('cat_id')->references('id')->on('product_categories');
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
              // Drop foreign key constraint
              $table->dropForeign(['cat_id']);

              // Drop cat_id column
              $table->dropColumn('cat_id');
        });
    }
};
