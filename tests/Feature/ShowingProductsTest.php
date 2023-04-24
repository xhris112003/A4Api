<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Product;

class ShowingProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_get_all_products()
    {
        // Creamos algunos productos en la base de datos para probar
        $products = Product::factory()->count(3)->create();

        // Hacemos una petición GET a la ruta de los productos
        $response = $this->get('/api/products');

        // Aseguramos que la respuesta tenga un status HTTP 200
        $response->assertStatus(200);

        // Aseguramos que la respuesta tenga el mismo número de productos creados
        $response->assertJsonCount(3);

        // Aseguramos que la respuesta tenga los mismos datos de los productos creados
        $response->assertJsonFragment([
            'name' => $products[0]->name,
            'description' => $products[0]->description,
            'price' => $products[0]->price,
            'provider_id' => $products[0]->provider_id,

        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_get_single_product()
    {
        // Creamos un producto en la base de datos para probar
        $product = Product::factory()->create();

        // Hacemos una petición GET a la ruta del producto creado
        $response = $this->get('/api/products/' . $product->id);

        // Aseguramos que la respuesta tenga un status HTTP 200
        $response->assertStatus(200);

        // Aseguramos que la respuesta tenga los mismos datos del producto creado
        $response->assertJson([
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'provider_id' => $product->provider_id,
        ]);
    }
}