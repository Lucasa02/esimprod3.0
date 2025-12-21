<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerawatanInventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barang_id'        => 'required|exists:bmn_barangs,id',
            'tanggal_perawatan'=> 'required|date',
            'jenis_perawatan'  => 'required|in:perbaikan,rencana_penghapusan,penghapusan',
            'deskripsi'        => 'nullable|string',
            'status'           => 'required|in:proses,pending,selesai',
            'biaya'            => 'nullable|numeric',
            'foto_bukti'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_kerusakan'   => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'surat_penghapusan'=> 'nullable|mimes:pdf|max:4096',
        ];
    }
}
