<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
//        Schema::table('users', function(Blueprint $table) {
//            $table->foreign('role_id')
//                    ->references('id')
//                    ->on('roles')
//                    ->onDelete('cascade')
//                    ->onUpdate('cascade');
//        });
        Schema::table('foods', function(Blueprint $table) {
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
//        Schema::table('foods', function(Blueprint $table) {
//            $table->dropForeign(['category_id']);
//        });
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['id_role']);
        });
    }

}
