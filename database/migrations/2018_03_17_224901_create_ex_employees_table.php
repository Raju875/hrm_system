<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ex_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_official_id');
            $table->string('employee_name','100');
            $table->string('father_name','100');
            $table->string('mother_name','100');
            $table->date('date_of_birth');
            $table->string('phone_no');
            $table->string('email','180')->unique();
            $table->integer('national_id_no');
            $table->text('present_address');
            $table->string('official_email','180')->unique();
            $table->string('official_password','180')->unique();
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
        Schema::dropIfExists('ex_employees');
    }
}
