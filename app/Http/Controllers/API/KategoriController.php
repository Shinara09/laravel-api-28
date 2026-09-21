<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Http\Requests\KategoriRequest;
use App\Http\Resources\KategoriResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::latest()->paginate(10);
        return response()->json(KategoriResource::collection($kategori), Response::HTTP_OK);
    }

    public function store(KategoriRequest $request)
    {
        $kategori = Kategori::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Kategori created successfully',
            'data' => new KategoriResource($kategori),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'status'  => true,
            'message' => 'Detail Kategori',
            'data'    => new KategoriResource($kategori),
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriRequest $request, string $id)
    {
        $kategori->update($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Kategori updated successfully',
            'data'    => new KategoriResource($kategori),
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Kategori deleted successfully',
        ], Response::HTTP_OK);
    }
}