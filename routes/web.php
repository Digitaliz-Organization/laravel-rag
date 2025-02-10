<?php

use App\Domains\Chunking\ChunkText;
use App\Services\LlmServices\LlmDriverFacade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use \Probots\Pinecone\Client as Pinecone;

Route::get('/', function () {

    // $apiKey = env('PINECONE_API_KEY');
    // $indexHost = env('PINECONE_INDEX_HOST');
    // $pinecone = new Pinecone($apiKey, $indexHost);

    return view('welcome');
});
