<?php

use Leaf\Schema;
use Leaf\Database;
use Illuminate\Database\Schema\Blueprint;

class CreatePrintModels extends Database
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        if (!static::$capsule::schema()->hasTable('print_models')) :
            static::$capsule::schema()->create('print_models', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

                $table->string('name', 50);
                $table->text('description');
                $table->unsignedInteger('cost');
                $table->text('credits');
                $table->boolean('private')->default(false);
                $table->boolean('approved')->nullable();
                $table->string('folder')->unique();

                $table->timestamps();
                $table->softDeletes();
            });
        endif;

        // you can now build your migrations with schemas.
        // see: https://leafphp.dev/docs/mvc/schema.html
        // Schema::build('print_models');
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        static::$capsule::schema()->dropIfExists('print_models');
    }
}
