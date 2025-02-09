<?php

use App\Domains\Chunking\ChunkText;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    // $file = Storage::get("documents/1.pdf");
    return $file = Storage::get("documents/smaller_text.txt");

    (new ChunkText())->chunk($file);

    return view('welcome');
});
