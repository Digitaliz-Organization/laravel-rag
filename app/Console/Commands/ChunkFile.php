<?php

namespace App\Console\Commands;

use App\Domains\Chunking\ChunkText;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
        $text = $this->pdf();
        (new ChunkText())->chunk($text);

        $this->info('File has been chunked');
    }

    private function pdf()
    {
        $path = public_path("documents/1.pdf");

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($path);
        $text = $pdf->getText();

        return $text;
    }

    private function excel()
    {
        // get path
        $path = public_path("documents/rev-1.xlsx");

        // Load the XLSX file
        $spreadsheet = IOFactory::load($path);

        // Convert the content to text
        $text = '';
        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                foreach ($cellIterator as $cell) {
                    $text .= $cell->getValue() . "\t";
                }
                $text .= "\n";
            }
        }

        return $text;
    }
}
