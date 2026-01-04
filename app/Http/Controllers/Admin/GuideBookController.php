<?php

namespace App\Http\Controllers\Admin;

use App\Models\GuideBook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GuideBookController extends Controller
{
	public function index()
	{
		$data = [
			'title' => 'Buku Panduan',
			'guideBook' => GuideBook::latest()->get() // Ditambahkan latest() agar urutan terbaru di atas
		];

		return view('admin.guidebook.index', $data);
	}

	public function store(Request $request)
	{
		$request->validate([
			'file' => 'required|file|mimes:pdf|max:2048',
		], [
			'file.required' => 'File wajib diisi.',
			'file.file' => 'File harus berupa file.',
			'file.mimes' => 'File harus dalam format pdf.',
			'file.max' => 'Ukuran file maksimal adalah 2MB.',
		]);

		// Logic: Matikan status 'used' pada file lama sebelum mengupload yang baru
		GuideBook::where('status', 'used')->update(['status' => 'unused']);

		if ($request->hasFile('file')) {
			$file = $request->file('file');
			$filename = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('uploads/guidebook', $filename, 'public');

			GuideBook::create([
				'uuid' => (string) Str::uuid(),
				'file' => $filename,
				'status' => 'used' // Otomatis aktif setelah upload
			]);

			notify()->success('Guidebook berhasil diupload dan diaktifkan!');
		}

		return redirect()->back();
	}

	public function unused(string $uuid)
	{
		GuideBook::where('uuid', $uuid)
			->firstOrFail()
			->update([
				'status' => 'unused'
			]);

		notify()->warning('Guidebook dinonaktifkan!');
		return redirect()->back();
	}

	public function used(string $uuid)
	{
		// Logic: Pastikan hanya ada satu file yang berstatus 'used'
		GuideBook::where('status', 'used')->update(['status' => 'unused']);

		GuideBook::where('uuid', $uuid)
			->firstOrFail()
			->update([
				'status' => 'used'
			]);

		notify()->success('Guidebook berhasil diaktifkan!');
		return redirect()->back();
	}

	public function destroy(string $uuid)
	{
		$book = GuideBook::where('uuid', $uuid)->firstOrFail();

		// Hapus file dari storage fisik
		if (Storage::disk('public')->exists('uploads/guidebook/' . $book->file)) {
			Storage::disk('public')->delete('uploads/guidebook/' . $book->file);
		}

		// Hapus data dari database
		$book->delete();

		notify()->success('Guidebook berhasil dihapus!');
		return redirect()->back();
	}
}