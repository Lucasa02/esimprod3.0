<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;

class RepairMissingUserQr extends Command
{
    protected $signature = 'user:repair-missing-qr
                            {--overwrite : Regenerate dan timpa file meski file lama masih ada}
                            {--format=png : Format output (png|svg)}
                            {--size=200 : Ukuran sisi QR (px)}';

    protected $description = 'Regenerate QR untuk user yang file QR-nya hilang (atau pakai --overwrite untuk semua)';

    public function handle()
    {
        $format = strtolower($this->option('format') ?? 'png');
        $size   = (int) $this->option('size') ?: 200;
        $overwrite = (bool) $this->option('overwrite');

        if (!in_array($format, ['png','svg'])) {
            $this->error('Format tidak valid. Gunakan png atau svg.');
            return self::INVALID;
        }

        $disk = Storage::disk('public');
        $dir  = 'uploads/qr_codes_user';

        // Ambil semua user yang punya kode_user (kode sumber QR)
        $users = User::whereNotNull('kode_user')->get();

        $total = 0; $ok = 0; $skip = 0; $fail = 0;

        foreach ($users as $user) {
            $total++;

            $current = $user->qr_code; // nama file di DB, boleh null
            $path    = $current ? "{$dir}/{$current}" : null;

            $missing = !$current || !$disk->exists($path);

            if (!$missing && !$overwrite) {
                $skip++;
                $this->line("SKIP: {$user->nama_lengkap} ({$user->kode_user}) – file ada: {$current}");
                continue;
            }

            try {
                // generate konten QR dari kode_user
                $qr = QrCode::format($format)->size($size)->generate($user->kode_user);

                // tentukan nama file
                if ($overwrite && $current) {
                    $filename = $current; // timpa file lama
                } else {
                    $filename = Str::uuid() . "_qr.{$format}";
                }

                // simpan file
                $disk->put("{$dir}/{$filename}", $qr);

                // kalau nama baru, update DB & hapus lama (kalau ada dan beda)
                if (!$current || $filename !== $current) {
                    if ($current && $disk->exists($path) && !$overwrite) {
                        $disk->delete($path);
                    }
                    $user->qr_code = $filename;
                    $user->save();
                }

                $ok++;
                $this->info("OK  : {$user->nama_lengkap} ({$user->kode_user}) -> {$filename}");
            } catch (\Throwable $e) {
                $fail++;
                $this->error("FAIL: {$user->nama_lengkap} ({$user->kode_user}) -> {$e->getMessage()}");
            }
        }

        $this->newLine();
        $this->info("Selesai. total={$total}, ok={$ok}, skip={$skip}, fail={$fail}");

        return self::SUCCESS;
    }
}