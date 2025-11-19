<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    // tampilkan semua data
    public function index() {
        $genres = Genre::all();

        if ($genres->isEmpty()) {
            return response()->json([
                "success" => true,
                "mesaage" => "Resource data not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $genres
        ], 200);
    }

    // upload data
    public function store(Request $request) {
        // 1. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ]);

        // 2. cek validator error
        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        // 3. upload image
        // $image = $request->file('cover_photo');
        // $image->store('books', 'public');

        // 4. insert data
        $genre = Genre::create([
            'name'=> $request->name,
            'description'=> $request->description
        ]);

        // 5. response
        return response()->json([
            'success' => true,
            'message' => 'Resource added successfuly!',
            'data' => $genre
        ], 201);
    }

    // cara salah satu data
    public function show(string $id) {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found"
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $genre
        ], 200);
    }

    // update data
    public function update(string $id, Request $request) {
        // 1. mencari data
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found"
            ], 404);
        }        

        // 2. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        // 3. siapkan data yang ingin diupdate
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];

        // // 4. handle image (upload & delete image)
        // if ($request->hasFile('photo')) {
        //     $image = $request->file('photo');
        //     $image->store('authors', 'public');

        //     if ($author->photo) {
        //         Storage::disk('public')->delete('authors/' . $author->photo);
        //     }

        //     $data['photo'] = $image->hashName();
        // }

        // 5. updata data baru ke database
        $genre->update($data);

        //  response saat data berhasil dirubah
        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfuly!',
            'data' => $genre
        ], 200);
    }

    // delete data
    public function destroy(string $id) {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found"
            ], 404);
        }

        // if ($author->photo) {
        //     // delete dari storage
        //     Storage::disk('public')->delete('authors/' . $author->photo);
        // }

        $genre->delete();
    }
}

