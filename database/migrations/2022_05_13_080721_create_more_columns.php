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
        Schema::table('users', function (Blueprint $table) {
            $table->string('country')->nullable()->after('password');
            $table->string('state')->nullable()->after('password');
            $table->string('code')->nullable()->after('password');
            $table->string('city')->nullable()->after('password');
            $table->string('address')->nullable()->after('password');
            $table->string('nationality')->nullable()->after('password');
            $table->date('dob')->nullable()->after('password');
            $table->string('phone')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('dob');
            $table->dropColumn('nationality');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('code');
            $table->dropColumn('state');
            $table->dropColumn('country');
        });
    }
};