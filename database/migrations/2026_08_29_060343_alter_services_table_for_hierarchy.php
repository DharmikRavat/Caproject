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
        Schema::table('services', function (Blueprint $table) {
            // These columns were already dropped/added in the failed attempt
            // We just need to do the renaming which requires doctrine/dbal, and add foreign keys
            
            $table->renameColumn('title', 'name');
            $table->renameColumn('full_description', 'description');
            $table->renameColumn('is_active', 'status');

            $table->foreign('category_id')->references('id')->on('service_categories')->onDelete('set null');
            $table->foreign('parent_service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
