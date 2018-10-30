<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->integer('project_id')->comment('项目id');
            $table->integer('version_id')->comment('版本id');
            $table->timestamp('current_time')->comment('记录时间');
            $table->string('body')->comment('内容');
            $table->integer('step_id')->comment('工作安排id');
            $table->double('work_time')->comment('本次记录工作时长');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('records');
    }
}
