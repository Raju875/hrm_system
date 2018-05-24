<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_leave_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_official_id');
            $table->string('to_email');
            $table->date('submitted_date');
            $table->date('leave_starting_date');
            $table->date('leave_ending_date');
            $table->string('intervals');
            $table->text('reason');
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
        Schema::dropIfExists('pending_leave_requests');
    }
}
