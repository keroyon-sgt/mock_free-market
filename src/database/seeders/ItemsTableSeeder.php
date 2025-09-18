<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 1,
            'user_id' => 1,
            'title' => '腕時計',
            'price' => '15000',
            'brand' => 'Rolax',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'image_path' => '1.jpg',
            'condition' => 'a',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 2,
            'user_id' => 2,
            'title' => 'HDD',
            'price' => '5000',
            'brand' => '西芝',
            'description' => '高速で信頼性の高いハードディスク',
            'image_path' => '2.jpg',
            'condition' => 'b',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 3,
            'user_id' => 3,
            'title' => '玉ねぎ3束',
            'price' => '300',
            'brand' => 'なし',
            'description' => '新鮮な玉ねぎ3束のセット',
            'image_path' => '3.jpg',
            'condition' => 'c',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 4,
            'user_id' => 4,
            'title' => '革靴',
            'price' => '4000',
            'brand' => '',
            'description' => 'クラシックなデザインの革靴',
            'image_path' => '4.jpg',
            'condition' => 'd',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 5,
            'user_id' => 5,
            'title' => 'ノートPC',
            'price' => '45000',
            'brand' => '',
            'description' => '高性能なノートパソコン',
            'image_path' => '5.jpg',
            'condition' => 'a',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 6,
            'user_id' => 6,
            'title' => 'マイク',
            'price' => '8000',
            'brand' => 'なし',
            'description' => '高音質のレコーディング用マイク',
            'image_path' => '6.jpg',
            'condition' => 'b',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 7,
            'user_id' => 7,
            'title' => 'ショルダーバッグ',
            'price' => '3500',
            'brand' => '',
            'description' => 'おしゃれなショルダーバッグ',
            'image_path' => '7.jpg',
            'condition' => 'c',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 8,
            'user_id' => 8,
            'title' => 'タンブラー',
            'price' => '500',
            'brand' => 'なし',
            'description' => '使いやすいタンブラー',
            'image_path' => '8.jpg',
            'condition' => 'd',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 9,
            'user_id' => 9,
            'title' => 'コーヒーミル',
            'price' => '4000',
            'brand' => 'Starbacks',
            'description' => '手動のコーヒーミル',
            'image_path' => '9.jpg',
            'condition' => 'a',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 10,
            'user_id' => 10,
            'title' => 'メイクセット',
            'price' => '2500',
            'brand' => '',
            'description' => '便利なメイクアップセット',
            'image_path' => '10.jpg',
            'condition' => 'b',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);
    }
}
