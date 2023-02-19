<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [
            'name' => '管理者',
        ];
        Role::create($param);
        $param = [
            'name' => '店舗代表者',
        ];
        Role::create($param);
        $param = [
            'name' => '利用者',
        ];
        Role::create($param);
    }
}
