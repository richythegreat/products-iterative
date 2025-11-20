<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Product;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    #[Test]
    public function it_increases_quantity()
    {
        $product = new Product(['quantity' => 5]);

        $product->increase();

        $this->assertEquals(6, $product->quantity);
    }

    #[Test]
    public function it_decreases_quantity()
    {
        $product = new Product(['quantity' => 5]);

        $product->decrease();

        $this->assertEquals(4, $product->quantity);
    }

    #[Test]
    public function it_does_not_decrease_below_zero()
    {
        $product = new Product(['quantity' => 0]);

        $result = $product->decrease();

        $this->assertFalse($result);
        $this->assertEquals(0, $product->quantity);
    }
}
