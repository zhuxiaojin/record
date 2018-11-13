<?php

use Illuminate\Database\Seeder;

class StepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = ['name' => '调研'];
        $data[] = ['name' => '详细设计'];
        $data[] = ['name' => '研发'];
        $data[] = ['name' => '测试'];
        $data[] = ['name' => '上线&预上线'];
        DB::table('steps')->insert($data);
    }
}
