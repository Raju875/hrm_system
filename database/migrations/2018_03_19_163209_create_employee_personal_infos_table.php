<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_personal_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_name','100');
            $table->string('father_name','100');
            $table->string('mother_name','100');
            $table->date('date_of_birth');
            $table->string('phone_no');
            $table->string('email','180')->unique();
            $table->integer('national_id_no');
            $table->text('present_address');
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
        Schema::dropIfExists('employee_personal_infos');
    }
}
