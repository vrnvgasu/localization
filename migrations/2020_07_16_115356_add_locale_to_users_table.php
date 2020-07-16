<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocaleToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $conf = config('vrnvgasu_localization');
        $tableName = $conf['users_table'];

        if (!Schema::hasColumn($tableName, 'locale')) {
            Schema::table($tableName, function (Blueprint $table) use ($conf) {
                $table->string('locale')->default($conf['default'])->nullable();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $conf = config('vrnvgasu_localization');
        $tableName = $conf['users_table'];

        if (Schema::hasColumn($tableName, 'locale')) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('locale');
            });
        }
    }
}
