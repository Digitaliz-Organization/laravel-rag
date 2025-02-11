## Laravel RAG

Chat easily your documents with AI Chatbot, powered by Laravel RAG (Retrieval-Augmented Generation).

Big Thanks to [Alfred Nutile](https://alnutile.medium.com/) was inspired us to build this things based on his articles in [Laravel RAG System in 4 Steps!](https://alnutile.medium.com/laravel-rag-in-4-steps-6264b4df173a).

## How to Install:

```
- git@github.com:Digitaliz-Organization/laravel-rag.git
- cp .env.example .env
- composer install
- php artisan migrate
```

## Prepare the Document

We have several sample documents located in `public/documents`, you can add your own document over there.

## Chunk File

Please run this command to chunking file and it will run embedding process for that file.

```
php artisan chunk-file
```

by default the file will be chunk is `public/documents/1/pdf`, you can custom the file by edit `ChunkFile.php` file like so:

```
private function pdf()
{
    <!-- Edit name of file here -->
    $path = public_path("documents/1.pdf");

    $parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile($path);
    $text = $pdf->getText();

    return $text;
}
```

### Ask Your Document

Please run this command to open chatbot console.

```
php artisan chatbot
```

the command will be showing a basic question form: `ask me a question:` so you can ask everything about your files.

## Equipment Behind it

-   [Laravel 11](https://laravel.com)
-   [pgvector](https://github.com/pgvector/pgvector)
-   [smalot/pdfparser](https://github.com/smalot/pdfparser)
-   [spatie/laravel-data](https://spatie.be/docs/laravel-data/v4/introduction)
-   [openai-php/laravel](https://github.com/openai-php/laravel)
