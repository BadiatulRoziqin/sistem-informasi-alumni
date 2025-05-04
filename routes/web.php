<?php

use App\Models\Alumni;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/chart-alumni-jurusan', function () {
    $data = Alumni::select('jurusan', DB::raw('count(*) as total'))
        ->groupBy('jurusan')
        ->pluck('total', 'jurusan');

    return response()->json([
        'labels' => $data->keys(),
        'data' => $data->values(),
    ]);
})->name('chart.alumni.jurusan');
