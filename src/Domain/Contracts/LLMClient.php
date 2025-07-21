<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

/**
 * LLMClient Interface
 *
 * @package App\Domain\Contracts
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
interface LLMClient
{
    /**
    * send a message to LLM endpoint and get a response
    *
    * @param array $messages Chat messages, e.g., [['role' => 'user', 'content' => 'Hi']]
    * @param string $model Model name like 'gpt-4'
    * @param float $temperature Optional temperature setting
    *
    * @return string The LLM's response content
    */
    public function chat(array $messages, string $model = 'gpt-4', float $temperature = 0.7): string;
}
