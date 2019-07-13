<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastUpdatedByColumnToArchives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function up()
    {
        Schema::table(config('cms.db-prefix', '').'archives', function (Blueprint $table) {
            $userModel = config('cms.user-model', null);
            /** @var Model|null $userModel */
            $userModel = $userModel && class_exists($userModel) ? new $userModel() : null;

            $userTable = $userModel ? $userModel->getTable() : 'users';
            $keyCol = $userModel ? $userModel->getKey() : 'id';

            $table->integer('updated_by')->unsigned()->index()->nullable();

            $table->foreign('updated_by')->references($keyCol)->on($userTable);
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
        Schema::table(config('cms.db-prefix', '').'archives', function (Blueprint $table) {
            $connName = DB::connection()->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME);

            if ('sqlite' != $connName) {
                $table->dropForeign(['updated_by']);
            }
            $table->dropColumn(['updated_by']);
        });
    }
}
