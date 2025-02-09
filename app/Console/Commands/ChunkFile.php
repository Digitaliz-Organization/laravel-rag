<?php

namespace App\Console\Commands;

use App\Domains\Chunking\ChunkText;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ChunkFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chunk-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for chunking a file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // ask name of file
        // $file = Storage::get("documents/smaller_text.txt");

        // get path
        $path = Storage::path("documents/1.pdf");

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($path);
        $text = $pdf->getText();

        (new ChunkText())->chunk($text);

        $this->info('File has been chunked');
    }
}
