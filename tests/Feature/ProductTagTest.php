<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTagTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_tag_to_product()
    {
        // Create product
        $product = Product::factory()->create();

        // Send POST request as user adding a tag
        $response = $this->post("/products/{$product->id}/add-tag", [
            'tag' => 'sport'
        ]);

        // Check redirect (normal behavior)
        $response->assertRedirect();

        // Check tag was created
        $this->assertDatabaseHas('tags', [
            'name' => 'sport'
        ]);

        // Check pivot table was created
        $this->assertDatabaseHas('product_tag', [
            'product_id' => $product->id,
            'tag_id' => Tag::where('name', 'sport')->first()->id,
        ]);
    }
}
