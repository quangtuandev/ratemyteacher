<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class CustomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::table('kmt_item')->get();
        // dd($items);
        foreach($items as $item) {
            $km = $item->DonGia * 90/100;
            $idIT = $item->idIT;
            DB::table('kmt_item')
            ->where('idIT', $idIT)
            ->update(['DonGiaKM' => $km]);
        }

    }
}
