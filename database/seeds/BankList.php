<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(  ['name' => 'Ngân hàng TMCP Á Châu', 'shortname' => 'ACB', 'code'=> 'ASCBVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng TMCP Ngoại Thương Việt Nam', 'shortname' => 'VietcomBank', 'code'=> 'BFTVVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng TMCP Công Thương Việt Nam', 'shortname' => 'VietinBank', 'code'=> 'ICBVVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng TMCP Kỹ Thương Việt Nam', 'shortname' => 'Techcombank', 'code'=> 'VTCBVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng TMCP Đầu Tư Và Phát Triển Việt Nam', 'shortname' => 'BIDV', 'code'=> 'BIDVVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng TMCP Hàng Hải Việt Nam', 'shortname' => 'MaritimeBank', 'code'=> 'MCOBVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng Việt Nam Thịnh Vượng', 'shortname' => 'VPBank', 'code'=> 'VPBKVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng Nông nghiệp và Phát triển Việt Nam', 'shortname' => 'Agribank', 'code'=> 'VBAAVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng TMCP Xuất nhập khẩu Việt Nam', 'shortname' => 'Eximbank', 'code'=> 'EBVIVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng TMCP Sài Gòn Thương Tín', 'shortname' => 'Sacombank', 'code'=> 'SGTTVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng TMCP Tiên Phong', 'shortname' => 'TPBank', 'code'=> 'TPBVVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng thương mại cổ phần Quân đội', 'shortname' => 'MBBank', 'code'=> 'MSCBVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                        ['name' => 'Ngân hàng TMCP Quốc tế Việt Nam', 'shortname' => 'VIB', 'code'=> 'VNIBVNVX','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
                    );

        DB::table('bank_lists')->insert($data);
    }
}
