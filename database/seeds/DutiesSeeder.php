<?php

use Illuminate\Database\Seeder;

class DutiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);
        $data[] = ['name' => 'PHP'];
        $data[] = ['name' => 'Android'];
        $data[] = ['name' => 'IOS'];
        $data[] = ['name' => 'Java'];
        $data[] = ['name' => '测试'];
        $data[] = ['name' => '前端'];
        DB::table('duties')->insert($data);
    }
}
