<?php

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
        DB::table('categories')->insert([
            ['name' => '和食・日本料理'],
            ['name' => 'すし・魚料理'],
            ['name' => 'ラーメン・麺類'],
            ['name' => '丼もの・揚げ物'],
            ['name' => 'お好み焼・粉物'],
            ['name' => '郷土料理'],
            ['name' => 'アジア・エスニック'],
            ['name' => '中華'],
            ['name' => '洋食・西洋料理'],
            ['name' => 'イタリアン'],
            ['name' => 'フレンチ'],
            ['name' => 'アメリカ料理'],
            ['name' => 'アフリカ料理'],
            ['name' => '焼肉・ステーキ'],
            ['name' => '焼鳥・串料理'],
            ['name' => '鍋'],
            ['name' => 'しゃぶしゃぶ・すき焼き'],
            ['name' => '居酒屋・バー'],
            ['name' => 'カフェ・スイーツ'],
            ['name' => 'ファミレス・ファーストフード'],
            ['name' => 'ビュッフェ・バイキング'],
            ['name' => 'その他']
        ]);
    }
}
