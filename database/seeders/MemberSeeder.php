<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       return DB::table('members')->insert($this->returnMemberDataset());
    }

    private function returnMemberDataset(){
        return array(
            [
                'member_name' => 'Ratna Halimah',
                'member_phone' => '0328 9708 1863',
                'member_address' => 'Ds. Aceh No. 465, Bau-Bau 93002, KepR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'member_name' => 'Purwa Narpati',
                'member_phone' => '0335 4854 361',
                'member_address' => 'Gg. Flora No. 458, Administrasi Jakarta Pusat 21352, SulTeng',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'member_name' => 'Amelia Yulianti ',
                'member_phone' => '0913 8817 8921',
                'member_address' => 'Jr. Banceng Pondok No. 224, Pangkal Pinang 15360, Papua',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'member_name' => 'Jindra Rajata',
                'member_phone' => '(+62) 686 4725 5155',
                'member_address' => 'Kpg. Moch. Ramdan No. 893, Banjar 93926, Lampung',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'member_name' => 'Emas Prakasa',
                'member_phone' => '(+62) 908 6565 7475',
                'member_address' => 'Dk. Umalas No. 122, Solok 25025, NTB',
                'created_at' => now(),
                'updated_at' => now()
            ],
        );
    }
}
