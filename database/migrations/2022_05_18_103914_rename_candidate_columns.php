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
        Schema::table('candidates', function (Blueprint $table) {
            $table->renameColumn('candidate_name', 'name');
            $table->renameColumn('candidate_party', 'party');
            $table->renameColumn('candidate_image', 'image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->renameColumn('name', 'candidate_ame');
            $table->renameColumn('party', 'candidate_party');
            $table->renameColumn('image', 'candidate_image');
        });
    }
};