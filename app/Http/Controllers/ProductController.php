<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use OpenApi\Attributes as OA;

class ProductController extends Controller
{
    #[OA\Get(path: '/products', summary: 'Listado público del catálogo de productos', tags: ['Productos'])]
    #[OA\Response(response: 200, description: 'Lista de productos obtenida')]
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    #[OA\Post(path: '/products', summary: 'Crear un nuevo producto', security: [['bearerAuth' => []]], tags: ['Productos'])]
    #[OA\Response(response: 201, description: 'Producto creado con éxito')]
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json(['message' => 'Producto creado con éxito', 'data' => $product], 201);
    }

    #[OA\Get(path: '/products/{product}', summary: 'Ver el detalle de un producto específico', tags: ['Productos'])]
    #[OA\Parameter(name: 'product', in: 'path', required: true, description: 'ID del producto', schema: new OA\Schema(type: 'integer'))]
    #[OA\Response(response: 200, description: 'Detalle del producto')]
    #[OA\Response(response: 404, description: 'Producto no encontrado')]
    public function show(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($product, 200);
    }

    #[OA\Put(path: '/products/{product}', summary: 'Editar un producto existente', security: [['bearerAuth' => []]], tags: ['Productos'])]
    #[OA\Parameter(name: 'product', in: 'path', required: true, description: 'ID del producto', schema: new OA\Schema(type: 'integer'))]
    #[OA\Response(response: 200, description: 'Producto actualizado con éxito')]
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        $product->update($request->validated());
        return response()->json(['message' => 'Producto actualizado con éxito', 'data' => $product], 200);
    }

    #[OA\Delete(path: '/products/{product}', summary: 'Eliminar un producto', security: [['bearerAuth' => []]], tags: ['Productos'])]
    #[OA\Parameter(name: 'product', in: 'path', required: true, description: 'ID del producto', schema: new OA\Schema(type: 'integer'))]
    #[OA\Response(response: 200, description: 'Producto eliminado correctamente')]
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }
}

