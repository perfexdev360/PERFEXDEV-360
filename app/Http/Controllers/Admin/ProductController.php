<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $repository)
    {
        $this->authorizeResource(Product::class, 'product');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(ProductRequest $request)
    {
        $product = $this->repository->create($request->validated());
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($this->repository->find($product));
    }

    public function edit(Product $product)
    {
        return response()->json($this->repository->find($product));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product = $this->repository->update($product, $request->validated());
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $this->repository->delete($product);
        return response()->json(null, 204);
    }
}
