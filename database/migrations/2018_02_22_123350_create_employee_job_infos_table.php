<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeJobInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_job_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('employee_official_id','100')->unique();
            $table->string('official_email','180')->unique();
            $table->string('official_password');
            $table->string('official_phone_no');
            $table->string('designation');
            $table->float('salary');
            $table->tinyInteger('publication_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_job_infos');
    }
}
