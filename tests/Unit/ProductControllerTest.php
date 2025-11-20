<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_increase_quantity()
    {
        $controller = new ProductController();
        $product = Product::factory()->create(['quantity' => 5]);

        // Call the method directly
        $controller->increaseQuantity($product);

        $this->assertEquals(6, $product->fresh()->quantity);
    }

    public function test_decrease_quantity()
    {
        $controller = new ProductController();
        $product = Product::factory()->create(['quantity' => 5]);

        $controller->decreaseQuantity($product);

        $this->assertEquals(4, $product->fresh()->quantity);
    }

    public function test_decrease_quantity_cannot_go_below_zero()
    {
        $controller = new ProductController();
        $product = Product::factory()->create(['quantity' => 0]);

        $controller->decreaseQuantity($product);

        // Quantity should still be 0
        $this->assertEquals(0, $product->fresh()->quantity);
    }
}
