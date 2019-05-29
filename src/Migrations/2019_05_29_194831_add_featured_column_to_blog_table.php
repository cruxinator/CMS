<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturedColumnToBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function up()
    {
        Schema::table(config('cms.db-prefix', '').'blogs', function (Blueprint $table) {
            $table->boolean('is_featured')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function down()
    {
        Schema::table(config('cms.db-prefix', '').'blogs', function (Blueprint $table) {
            $table->dropColumn(['is_featured']);
        });
    }
}
