<?php

use Illuminate\Database\Migrations\Migration;

class ImportData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = file_get_contents(__DIR__ . '/dump.sql');

        echo DB::getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
