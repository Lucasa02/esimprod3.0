<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Studio1Controller extends Controller
{
    public function index()
    {
        $title = 'Daftar Peralatan Studio 1';
        return view('admin.studio1.index', compact('title'));
    }
}
