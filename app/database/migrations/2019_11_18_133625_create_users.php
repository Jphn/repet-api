<?php

use Illuminate\Database\Schema\Blueprint;
use Leaf\Database;
use Leaf\Schema;

class CreateUsers extends Database
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        // if (!static::$capsule::schema()->hasTable("users")):
        // 	static::$capsule::schema()->create("users", function (Blueprint $table) {
        //         $table->increments('id');
        // 		$table->string('name');
        // 		$table->string('email')->unique();
        // 		$table->timestamp('email_verified_at')->nullable();
        // 		$table->string('password');
        // 		$table->rememberToken();
        // 		$table->timestamps();
        // 	});
        // endif;

        if (!static::$capsule::schema()->hasTable("users")):
            static::$capsule::schema()->create("users", function (Blueprint $table) {
                $table->increments('id');

                $table->string('display_name');
                $table->string('username', 15)->unique();
                $table->string('email')->unique();
                $table->string('phone', 20);
                $table->date('birthdate');
                $table->string('registration', 14)->unique()->nullable();
                $table->string('password');

                $table->boolean('email_verified')->default(false);
                $table->uuid('email_verification_token')->unique()->nullable();
                $table->timestamp('email_verification_expires')->nullable();

                $table->timestamps();
                $table->timestamp('deleted_at')->nullable();
                // $table->rememberToken();
            });
        endif;

        /**
         * Leaf Schema allows you to build migrations
         * from a JSON representation of your database
         *
         * Check app/database/schema/users.json for an example
         *
         * Docs @ https://leafphp.dev/docs/mvc/schema.html
         */
        // you can now build your migrations with schemas
        // Schema::build('users');
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        static::$capsule::schema()->dropIfExists('users');
    }
}
