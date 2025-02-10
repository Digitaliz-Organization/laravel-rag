<?php

namespace App\Console\Commands;

use App\Services\LlmServices\DistanceQuery;
use App\Services\LlmServices\LlmDriverFacade;
use Illuminate\Console\Command;

class ChatbotAI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chatbot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for chatbot AI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $question = $this->ask('Ask me a question');

        $embedQuestion = LlmDriverFacade::driver(config('llmdriver.driver'))
            ->embedData($question);

        $results = (new DistanceQuery)->cosineDistance(
            get_embedding_size(config('llmdriver.driver')),
            $embedQuestion->embedding
        );

        $content = [];

        foreach ($results as $result) {
            $contentString = remove_ascii($result->content);
            $content[] = $contentString;
        }

        $context = implode(' ', $content);

        $prompt = "
        **ROLE**
        Your role is as a Chatbot in a RAG (Retrieval augmented generation system) you will answer the question of the user without drifting from the context provided. If you do not have enough info for the question in the context please just say say

        **TASK**
        Below is the INPUT of the user and the CONTEXT provided by the system that it found related to the users INPUT.
        Use that CONTEXT to answer their INPUT

        **FORMAT**
        Return as Markdown

        **INPUT FROM THE USER**
        $question
        **END INPUT FROM THE USER**

        **CONTEXT FROM THE RAG SYSTEM**
        $context";

        $results = LlmDriverFacade::driver(config('llmdriver.driver'))
            ->completion($prompt);

        $this->info($results->content);
    }
}
