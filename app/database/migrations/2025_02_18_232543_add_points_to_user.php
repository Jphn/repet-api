<?php

use Illuminate\Database\Schema\Blueprint;
use Leaf\Database;

class AddPointsToUser extends Database
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        static::$capsule::schema()->table('users', function (Blueprint $table) {
            // You can modify columns like this code below

            // $column = static::$capsule::schema()->hasColumn('users', 'columnName');

            // if ($column) {
            //     $table->integer('columnName')->default(0)->change();
            // } else {
            //     $table->integer('columnName')->default(0);
            // }
            if (!static::$capsule::schema()->hasColumn('users', 'points')) {
                $table->unsignedInteger('points')->default(0)->after('registration');
            }
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        // static::$capsule::schema()->dropIfExists('users');
        if (static::$capsule::schema()->hasColumn('users', 'country_code')) {
            static::$capsule::schema()->dropColumns('users', 'points');
        }
    }
}
