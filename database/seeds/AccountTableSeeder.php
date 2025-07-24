<?php

use App\Account;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            ['id' => 1, 'business_id' => NULL, 'name' => 'أرصدة العملاء', 'account_number' => 5000, 'account_details' => NULL , 'account_type_id' => 2 , 'note' => NULL],
            ['id' => 2, 'business_id' => NULL, 'name' => 'أرصدة الموردين', 'account_number' => 10000, 'account_details' => NULL , 'account_type_id' => 5 , 'note' => NULL],
            ['id' => 3, 'business_id' => NULL, 'name' => 'المخزن', 'account_number' => 15000, 'account_details' => NULL , 'account_type_id' => 2 , 'note' => NULL],
            ['id' => 4, 'business_id' => NULL, 'name' => 'صافي الربح', 'account_number' => 20000, 'account_details' => NULL , 'account_type_id' => NULL , 'note' => NULL],
            ['id' => 5, 'business_id' => NULL, 'name' => 'تسويات القيد الافتتاحي', 'account_number' => 25000, 'account_details' => NULL , 'account_type_id' => NULL , 'note' => NULL],
			['id' => 100, 'business_id' => NULL, 'name' => 'ضريبة المبيعات', 'account_number' => 30000, 'account_details' => NULL , 'account_type_id' => 13 , 'note' => NULL],
            ['id' => 200, 'business_id' => NULL, 'name' => ' ضريبة المشتريات و المصاريف', 'account_number' => 35000, 'account_details' => NULL , 'account_type_id' => 2 , 'note' => NULL],
            ['id' => 300, 'business_id' => NULL, 'name' => 'ضريبة القيمة المضافة المستحقة', 'account_number' => 40000, 'account_details' => NULL , 'account_type_id' => 13 , 'note' => NULL],

        ];

        $insert_data = [];
        $time_stamp = Carbon::now()->toDateTimeString();
        foreach ($data as $d) {
            // $d['guard_name'] = 'web';
            $d['created_at'] = $time_stamp;
            $insert_data[] = $d;
        }
        Account::insert($insert_data);
    }
}

