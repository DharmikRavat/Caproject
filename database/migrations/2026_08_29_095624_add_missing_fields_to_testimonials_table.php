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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('source')->default('Google')->after('content');
            $table->date('review_date')->nullable()->after('source');
            $table->boolean('is_verified')->default(true)->after('review_date');
            $table->integer('sort_order')->default(0)->after('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['source', 'review_date', 'is_verified', 'sort_order']);
        });
    }
};
