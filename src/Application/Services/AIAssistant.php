<?php

namespace App\Application\Services;

use App\Application\Contracts\AIAssistant as AIAssistantInterface;
use App\Domain\Contracts\LLMClient;
use App\Shared\Exception\InvalidAnswerException;

/**
 * AIAssistant Service
 *
 * @package App\Application\Services
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class AIAssistant implements AIAssistantInterface
{
    /**
     * Constructor
     *
     * @param LLMClient $llmClient
     */
    public function __construct(
        private LLMClient $llmClient
    ) {
    }

    /**
     * SuggestWord
     *
     * @param string $categiryId
     * @param string $model name of the applied AI model
     * @return string
     * @throws InvalidAnswerException
     */
    public function suggestWord(string $categoryId, $model): string
    {
        $prompt = '';

        $response = $this->llmClient->chat($this->createMessages($prompt), $model);
        
        return $response;
    }

    /**
     * askQuestion
     *
     * @param string $question
     * @param string $model
     * @return string answer to the question
     * @throws InvalidAnswerException
     */
    public function askQuestion(string $question, string $model): string
    {
        $prompt = '';

        $response = $this->llmClient->chat($this->createMessages($prompt), $model);
        
        if (!in_array(strtolower(trim($response)), ["yes", "no"])) {
            throw new InvalidAnswerException('Invalid response from AI');
        }

        return $response;
    }

    private function createMessages(string $prompt): array
    {
        return [
            ['role' => 'system', 'content' => 'You are a helpful AI assistant.'],
            ['role' => 'user', 'content' => $prompt],
        ];
    }

    /**
     * GenerateQuestionprompt
     * Provide a prompt for the AI assistant
     *
     * @param $secretWord string
     * @param $playerQuestion string
     * @return string
     */
    protected static function generateQuestionPrompt(string $secretWord, string $playerQuestion): string
    {
        return <<<EOT
                You are playing a game called "20 Questions". The secret word is: "{$secretWord}".
                The player asks: "{$playerQuestion}"
                Your job is to answer ONLY "Yes" or "No" based on the word "{$secretWord}".
                Do not reveal the word, give clues, or explain your answer. Just respond with "Yes" or "No".
            EOT;
    }

    /**
     * Generate random word in organism category
     *
     * @param string $categoryId
     * @return string
     */
    protected static function generateRandomOrganism(string $categoryId): string
    {
        return <<<EOT
            Pick one random word that is an organism (like "cat", "tree", "mushroom").
            Just return the word with no explanation.
        EOT;
    }

    /**
     * Generate random word in object category
     *
     * @param string $categoryId
     * @return string
     */
    protected static function generateRandomObject(string $categoryId): string
    {
        return <<<EOT
            Pick one random word that is an object (like "chair", "toothbrush", "computer").
            Just return the word with no explanation.
        EOT;
    }

    /**
     * Generate random word in concept category
     *
     * @param string $categoryId
     * @return string
     */
    protected static function generateRandomConcept(string $categoryId): string
    {
        return <<<EOT
            Pick one random word that is a concept (like "freedom", "justice", "time").
            Just return the word with no explanation.
        EOT;
    }
}
