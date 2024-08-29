<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pinjam;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function getBook() {
        return response()->json([
            "data" => Book::all(),
        ], 200);
    }

    public function getPinjam() {
        return response()->json([
            "data" => Pinjam::all(),
        ], 200);
    }

    public function create(Request $request) {
        $name = $request->input('name');
        $book_id = $request->input('bookId');

        if (!$name || !$book_id) {
            return response()->json([
                "message" => "Pastikan input terisi ",
            ], 400);
        }

        if (count(Book::where('id', $book_id)->get()) < 1) {
            return response()->json([
                "message" => "Buku tidak ditemukan",
            ], 404);
        }

        Pinjam::create([
            "name" => $name,
            "book_id" => $book_id,
        ]);

        return response()->json([
            "message" => "Peminjaman berhasil",
        ], 201);
    }

    public function update(Request $request, string $id) {
        $name = $request->input('name');
        $book_id = $request->input('bookId');

        $pinjam = Pinjam::find($id);

        if (!$pinjam) {
            return response()->json([
                "message" => "Data tidak ditemukan",
            ], 404);
        }

        $pinjam->update([
            "name" => $name ?? $pinjam->name,
            "book_id" => $book_id ?? $pinjam->book_id,
        ]);

        return response()->json([
            "message" => "Update berhasil",
        ]);
    }

    public function delete(string $id) {
        $pinjam = Pinjam::find($id);

        if (!$pinjam) {
            return response()->json([
                "message" => "Data tidak ditemukan",
            ], 404);
        }

        $pinjam->delete();

        return response()->json([
            "message" => "Berhasil dihapus",
        ]);
    }
}
