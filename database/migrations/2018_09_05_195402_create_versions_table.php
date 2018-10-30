<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('versions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->comment('归属项目');
            $table->integer('user_id')->comment('版本管理员');
            $table->string('name')->comment('版本名称');
            $table->text('body')->comment('内容简介');
            $table->timestamp('end_time')->comment('项目结束时间');
            $table->boolean('is_end')->default(0)->comment('是否完结');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('versions');
    }
}
