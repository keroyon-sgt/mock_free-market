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
            'title' => '腕時計',
            'price' => '15000',
            'brand' => 'Rolax',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
            'condition' => 'a',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 2,
            'title' => 'HDD',
            'price' => '5000',
            'brand' => '西芝',
            'description' => '高速で信頼性の高いハードディスク',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
            'condition' => 'b',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 3,
            'title' => '玉ねぎ3束',
            'price' => '300',
            'brand' => 'なし',
            'description' => '新鮮な玉ねぎ3束のセット',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
            'condition' => 'c',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 4,
            'title' => '革靴',
            'price' => '4000',
            'brand' => '',
            'description' => 'クラシックなデザインの革靴',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
            'condition' => 'd',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 5,
            'title' => 'ノートPC',
            'price' => '45000',
            'brand' => '',
            'description' => '高性能なノートパソコン',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
            'condition' => 'a',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 6,
            'title' => 'マイク',
            'price' => '8000',
            'brand' => 'なし',
            'description' => '高音質のレコーディング用マイク',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
            'condition' => 'b',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 7,
            'title' => 'ショルダーバッグ',
            'price' => '3500',
            'brand' => '',
            'description' => 'おしゃれなショルダーバッグ',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
            'condition' => 'c',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 8,
            'title' => 'タンブラー',
            'price' => '500',
            'brand' => 'なし',
            'description' => '使いやすいタンブラー',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
            'condition' => 'd',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 9,
            'title' => 'コーヒーミル',
            'price' => '4000',
            'brand' => 'Starbacks',
            'description' => '手動のコーヒーミル',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
            'condition' => 'a',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => 10,
            'title' => 'メイクセット',
            'price' => '2500',
            'brand' => '',
            'description' => '便利なメイクアップセット',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
            'condition' => 'b',
            'stock' => 1,
        ];
        DB::table('items')->insert($param);
    }
}
