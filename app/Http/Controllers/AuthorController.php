<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::all();
        
        if ($authors->isEmpty()) {
            return response()->json([
                "success" => true,
                "mesaage" => "Resource data not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $authors
        ], 200);
    }

        public function store(Request $request) {
        // 1. validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:4096',
            'bio' => 'required|string'
        ]);

        // 2. cek validator error
        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        // 3. upload image
        $image = $request->file('photo');
        $image->store('authors', 'public');

        // 4. insert data
        $author = Author::create([
            'name' => $request->name,
            'photo' => $image->hashName(),
            'bio' => $request->bio
        ]);

        // 5. response
        return response()->json([
            'success' => true,
            'message' => 'Resource added successfuly!',
            'data' => $author
        ], 201);
    }
}
