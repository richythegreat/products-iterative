<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('index shows products', function () {
    Product::factory()->count(3)->create();

    $response = $this->get('/products');

    $response->assertStatus(200);
    $response->assertViewHas('products');
});

test('store creates a new product', function () {
    $data = [
        'name' => 'Test Product',
        'description' => 'Some description',
        'price' => 9.99,
        'quantity' => 5,
    ];

    $response = $this->post('/products', $data);

    $response->assertRedirect('/products');
    $this->assertDatabaseHas('products', ['name' => 'Test Product']);
});

test('show displays a product', function () {
    $product = Product::factory()->create();

    $response = $this->get('/products/' . $product->id);

    $response->assertStatus(200);
    $response->assertViewHas('product');
});

test('update modifies a product', function () {
    $product = Product::factory()->create();

    $response = $this->put('/products/' . $product->id, [
        'name' => 'Updated Name',
        'description' => 'Updated description',
        'price' => 15.00
    ]);

    $response->assertRedirect('/products');
    $this->assertDatabaseHas('products', ['name' => 'Updated Name']);
});

test('destroy deletes a product', function () {
    $product = Product::factory()->create();

    $response = $this->delete('/products/' . $product->id);

    $response->assertRedirect('/products');
    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});

test('increase quantity increases product quantity', function () {
    $product = Product::factory()->create(['quantity' => 5]);

    $response = $this->post('/products/' . $product->id . '/increase');

    $response->assertRedirect('/products/' . $product->id);
    $this->assertDatabaseHas('products', ['quantity' => 6]);
});

test('decrease quantity decreases product quantity', function () {
    $product = Product::factory()->create(['quantity' => 5]);

    $response = $this->post('/products/' . $product->id . '/decrease');

    $response->assertRedirect('/products/' . $product->id);
    $this->assertDatabaseHas('products', ['quantity' => 4]);
});

test('decrease quantity fails when quantity is 0', function () {
    $product = Product::factory()->create(['quantity' => 0]);

    $response = $this->post('/products/' . $product->id . '/decrease');

    $response->assertRedirect('/products/' . $product->id);
    $response->assertSessionHas('error');
});
