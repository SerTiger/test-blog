<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = ([
            ['title'       => 'Web3', 'slug'=>'web3'],
            ['title'       => 'DeFi', 'slug'=>'defi'],
            ['title'       => 'NFT', 'slug'=>'nft'],
            ['title'       => 'Protocols', 'slug'=>'protocols'],
            ['title'       => 'Metaverse', 'slug'=>'metaverse'],
            ['title'       => 'Gaming', 'slug'=>'gaming']
        ]);
        foreach($data as $category)
            Category::create($category);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
