<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $diaries = $user->diaries()->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar diary berhasil diambil.',
            'data' => $diaries
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $diary = Auth::user()->diaries()->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Diary berhasil ditambahkan.',
            'data' => $diary
        ], 201);
    }

    public function show($id)
    {
        $diary = Auth::user()->diaries()->find($id);

        if (!$diary) {
            return response()->json([
                'success' => false,
                'message' => 'Diary tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail diary berhasil diambil.',
            'data' => $diary
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $diary = Auth::user()->diaries()->find($id);

        if (!$diary) {
            return response()->json([
                'success' => false,
                'message' => 'Diary tidak ditemukan.',
            ], 404);
        }

        $data = $request->validate([
            'date' => 'sometimes|required|date',
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $diary->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Diary berhasil diperbarui.',
            'data' => $diary
        ], 200);
    }

    public function destroy($id)
    {
        $diary = Auth::user()->diaries()->find($id);

        if (!$diary) {
            return response()->json([
                'success' => false,
                'message' => 'Diary tidak ditemukan.',
            ], 404);
        }

        $diary->delete();

        return response()->json([
            'success' => true,
            'message' => 'Diary berhasil dihapus.',
        ], 200);
    }
}
