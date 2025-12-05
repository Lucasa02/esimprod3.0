<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class OptimizeOldImages extends Command
{
    protected $signature = 'optimize:images';
    protected $description = 'Optimize & resize old images in uploads/foto_barang folder';

    public function handle()
    {
        $this->info("🔍 Memproses gambar lama...");

        $manager = new ImageManager(new Driver());
        $files = Storage::disk('public')->files('uploads/foto_barang');

        foreach ($files as $filePath) {
            $fullPath = storage_path('app/public/' . $filePath);

            // Skip default.jpg
            if (str_contains($filePath, 'default.jpg')) {
                continue;
            }

            // Baca gambar lama
            $image = $manager->read($fullPath);

            // Resize max 500x500
            $image->scaleDown(500, 500);

            // Canvas background putih
            $canvas = $manager->create(500, 500)->fill('#ffffff');
            $canvas->place($image, 'center');

            // Encode dengan kualitas 80
            $encoded = $canvas->encodeByExtension(pathinfo($fullPath, PATHINFO_EXTENSION), quality: 80);

            // Overwrite gambar lama
            Storage::disk('public')->put($filePath, $encoded);

            $this->info("✔ Optimized: {$filePath}");
        }

        $this->info("🎉 Semua gambar berhasil diresize & compress!");
        return Command::SUCCESS;
    }
}