<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductsSeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 配列形式で対応するデータを定義
        $productsSeasonsData = [
            ['product_id' => 1, 'season_id' => 3], // キウイ (秋)
            ['product_id' => 1, 'season_id' => 4], // キウイ (冬)
            ['product_id' => 2, 'season_id' => 1], // ストロベリー (春)
            ['product_id' => 3, 'season_id' => 4], // オレンジ (冬)
            ['product_id' => 4, 'season_id' => 2], // スイカ (夏)
            ['product_id' => 5, 'season_id' => 2], // ピーチ (夏)
            ['product_id' => 6, 'season_id' => 2], // シャインマスカット (夏)
            ['product_id' => 6, 'season_id' => 3], // シャインマスカット (秋)
            ['product_id' => 7, 'season_id' => 1], // パイナップル (春)
            ['product_id' => 7, 'season_id' => 2], // パイナップル (夏)
            ['product_id' => 8, 'season_id' => 2], // ブドウ (夏)
            ['product_id' => 8, 'season_id' => 3], // ブドウ (秋)
            ['product_id' => 9, 'season_id' => 2], // バナナ (夏)
            ['product_id' => 10, 'season_id' => 1], // メロン (春)
            ['product_id' => 10, 'season_id' => 2], // メロン (夏)
        ];

        // DB挿入ロジック
        foreach ($productsSeasonsData as $seasonConnection) {
        DB::table('products_seasons')->insert($seasonConnection);
        }
    }
}
