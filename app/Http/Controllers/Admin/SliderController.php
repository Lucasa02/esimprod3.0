<?php

namespace App\Http\Controllers\Admin;

use App\Models\SliderImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.index', [
            'slider' => SliderImage::all(),
            'title' => 'Slider Image'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('slider', 'public');

        SliderImage::create([
            'image_path' => $path
        ]);

        return redirect()->back()->with('success', 'Gambar slider berhasil di-upload.');
    }

    public function destroy($id)
{
    $slider = SliderImage::findOrFail($id);

    // hapus file fisik
    Storage::disk('public')->delete($slider->image_path);

    // hapus dari database
    $slider->delete();

    return redirect()->back()->with('success', 'Gambar slider berhasil dihapus.');
}

}
