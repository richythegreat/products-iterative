<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_the_product_index_page()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertViewIs('products.index');
    }

    /** @test */
    public function it_shows_the_create_page()
    {
        $response = $this->get('/products/create');
        $response->assertStatus(200);
        $response->assertViewIs('products.create');
    }

    /** @test */
    public function it_can_store_a_product()
    {
        $data = [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 19.99,
        ];

        $response = $this->post('/products', $data);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->put("/products/{$product->id}", [
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 49.99,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', ['name' => 'Updated Product']);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/products/{$product->id}");

        $response->assertRedirect('/products');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}