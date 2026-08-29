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
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('slug');
            $table->string('banner_image')->nullable()->after('is_active');
            $table->text('description')->nullable()->after('banner_image');
            $table->integer('sort_order')->default(0)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'banner_image', 'description', 'sort_order']);
        });
    }
};
