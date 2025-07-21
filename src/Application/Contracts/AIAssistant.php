<?php

namespace App\Application\Contracts;

/**
 * AIAssistant Interface
 *
 * @package App\Application\Contracts
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
interface AIAssistant
{
    /**
     * Suggest a random word in the certain category
     *
     * @param string $categoryId
     * @param string $model llm model name
     * @return string
     */
    public function suggestWord(string $categoryId, string $model): string;
    
    /**
     * Ask a question
     *
     * @param string $question
     * @return string $model llm model name
     */
    public function askQuestion(string $question, string $model): string;
}
