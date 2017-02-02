<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTests extends TestCase
{
    use DatabaseTransactions;

    public function test_get_cheapest_price_first()
    {
        factory(Product::class)->times(10)->create();

        $cheapest = factory(Product::class)->create([
            'price' => '50'
        ]);
        
        $expensive = factory(Product::class)->create([
            'price' => '1001'
        ]);

        $products = $this->get('/search?sort=price_asc');

        $this->assertEquals( $cheapest->id, collect(json_decode($products->content()))->first()->id );
        // dd(collect(json_decode($products->content()))->first(), collect(json_decode($products->content()))->last());
    }

    public function test_get_expensive_price_first()
    {
        factory(Product::class)->times(10)->create();

        $cheapest = factory(Product::class)->create([
            'price' => '50'
        ]);

        $expensive = factory(Product::class)->create([
            'price' => '1001'
        ]);

        $products = $this->get('/search?sort=price_desc');

        $this->assertEquals( $expensive->id, collect(json_decode($products->content()))->first()->id );
        // dd(collect(json_decode($products->content()))->first(), collect(json_decode($products->content()))->last());

    }
}
