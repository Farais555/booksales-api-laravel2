<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    // tampilkan semua data read
    public function index()  {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                "success" => true,
                "mesaage" => "Resource data not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $transactions
        ], 200);
    
    }

    // tambah data create
    public function store(Request $request) {
        // 1. validator dan cek validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        // 2. generate order number & unik | ORD-0003
        $uniqueCode = 'ORD' . strtoupper(uniqid());

        // 3. ambil user yang sedang login & cek login
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // 4. mencari data buku dari request
        $book = Book::find($request->book_id);

        // 5. cek stock buku
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stock not enough.'
            ], 400);
        }

        // 6. hitung total harga price.quantity
        $totalAmount = $book->price * $request->quantity;

        // 7. kurangi stock (update data buku)
        $book->stock -= $request->quantity;
        $book->save();

        // 8. simpan data transaction
        $transactions = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity, //
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            'success' => true,
            'message' => 'transaction succesfully',
            'data' => $transactions
        ], 201);

    }

    // tampilkan salah satu data
    public function show(string $id) {
        $transactions = Transaction::with('user', 'book')->find($id);
        
        if (!$transactions) {
            return response()->json([
                'success' => false,
                'message' => "Resource not found"
            ], 404);
        }

        // cek user yang bersangkutan dengan transaksinya
        $user = auth('api')->user();

        // hanya admin yang bisa melihat berbagai trnsksi
        if ($user->role !== 'admin' && $transactions->customer_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => "You do not own this transaction"
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $transactions
        ], 200);
    }

    // destroy data
    public function destroy(string $id) {
        $transactions = Transaction::find($id);

        if (!$transactions) {
            return response()->json([
                'success'=> false,
                'message' => 'Transaction not found'
            ], 404);
        }

        // mencari buku
        $book = Book::find($transactions->book_id);

        // kembalikan stok
        if ($book) {
            $book->stock += $transactions->quantity;
            $book->save();
        }

        // hapus data transaksi
        $transactions->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi deleted'
        ]);
    }
}
