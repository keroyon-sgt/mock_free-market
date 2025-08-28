<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
            'content' => 'ファッション',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 2,
            'content' => '家電',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 3,
            'content' => 'インテリア',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 4,
            'content' => 'レディース',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 5,
            'content' => 'メンズ',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 6,
            'content' => 'コスメ',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 7,
            'content' => '本',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 8,
            'content' => 'ゲーム',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 9,
            'content' => 'スポーツ',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 10,
            'content' => 'キッチン',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 11,
            'content' => 'ハンドメイド',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 12,
            'content' => 'アクセサリー',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 13,
            'content' => 'おもちゃ',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 14,
            'content' => 'ベビー・キッズ',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'id' => 15,
            'content' => 'その他',
        ];
        DB::table('categories')->insert($param);
    }
}
