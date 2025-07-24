<?php

use Carbon\Carbon;
use App\AccountType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AccountTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['id' => 1, 'name' => 'أصول ثابتة', 'parent_account_type_id' => NULL, 'business_id' => NULL],
            ['id' => 2, 'name' => 'الأصول المتداولة', 'parent_account_type_id' => NULL, 'business_id' => NULL],
            ['id' => 3, 'name' => 'ذمم مدينة أخرى', 'parent_account_type_id' => NULL, 'business_id' => NULL],
            ['id' => 4, 'name' => 'أصول أخرى', 'parent_account_type_id' => NULL, 'business_id' => NULL ],
            ['id' => 5, 'name' => 'الالتزامات', 'parent_account_type_id' => NULL, 'business_id' => NULL],
            ['id' => 6, 'name' => 'حقوق الملكية', 'parent_account_type_id' => NULL, 'business_id' => NULL],
            ['id' => 7, 'name' => 'أرباح وخسائر سنوات سابقة', 'parent_account_type_id' => NULL, 'business_id' => NULL],
            ['id' => 8, 'name' => 'بنك', 'parent_account_type_id' => '2' ,'business_id' => NULL],
            ['id' => 9, 'name' => 'نقدية', 'parent_account_type_id' => '2' ,'business_id' => NULL],
            ['id' => 10, 'name' => 'عهدة مالية', 'parent_account_type_id' => '2', 'business_id' => NULL],
            ['id' => 11, 'name' => 'مصاريف مدفوعة مقدم', 'parent_account_type_id' => '2', 'business_id' => NULL],
            ['id' => 12, 'name' => 'التزامات طويلة الأجل', 'parent_account_type_id' => '5', 'business_id' => NULL],
            ['id' => 13, 'name' => 'التزامات قصيرة الأجل', 'parent_account_type_id' => '5', 'business_id' => NULL],
            ['id' => 14, 'name' => 'التزامات أخرى', 'parent_account_type_id' => '5', 'business_id' => NULL],

        ];

        $insert_data = [];
        $time_stamp = Carbon::now()->toDateTimeString();
        foreach ($data as $d) {
            // $d['guard_name'] = 'web';
            $d['created_at'] = $time_stamp;
            $insert_data[] = $d;
        }
        AccountType::insert($insert_data);
    }
}
