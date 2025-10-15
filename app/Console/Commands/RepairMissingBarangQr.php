<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class RepairMissingBarangQr extends Command
{
    protected $signature = 'barang:repair-missing-qr';
    protected $description = 'Regenerate QR SVG for barang entries whose QR file is missing';

    public function handle()
    {
        $missing = Barang::whereNotNull('qr_code')->get()->filter(function($b){
            return !Storage::disk('public')->exists('uploads/qr_codes_barang/'.$b->qr_code);
        });

        $this->info("Found {$missing->count()} missing QR files.");

        foreach ($missing as $barang) {
            try {
                $svg = QrCode::format('svg')->size(200)->generate($barang->kode_barang);
                $fileName = Str::uuid().'_qr.svg'; // atau pakai $barang->qr_code
                Storage::disk('public')->put("uploads/qr_codes_barang/{$fileName}", $svg);

                if ($barang->qr_code !== $fileName) {
                    $barang->qr_code = $fileName;
                    $barang->save();
                }
                $this->info("OK: {$barang->kode_barang}");
            } catch (\Throwable $e) {
                $this->error("FAIL: {$barang->kode_barang} ({$e->getMessage()})");
            }
        }

        return self::SUCCESS;
    }
}
