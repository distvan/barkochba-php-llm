<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Contracts\AIAssistant;
use App\Domain\Contracts\QuestionRepository;
use App\Domain\Contracts\Storage;
use App\Shared\Http\JsonResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * QuestionController
 *
 * @package App\Http\Controllers
 */
class QuestionController
{
    /**
     * Constructor
     *
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        private QuestionRepository $questionRepository,
        private Storage $storage,
        private AIAssistant $aiAssistant
    ) {
    }

    /**
     * __invoke
     * Save a question for the current game
     *
     * @param ServerRequestInterface $request
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $result = ['result' => ''];
        $gameId = (int)$this->storage->load('game_id');
        $question = isset($request->getParsedBody()['question']) ? (string)$request->getParsedBody()['question'] : '';
        if ($gameId && $question) {
            $questionId = $this->questionRepository->saveQuestion(
                gameId: $gameId,
                question: $question,
                answer: $this->getAnswer($this->aiAssistant->askQuestion($question, $_ENV['AI_ASSISTANT_MODEL']))
            );
            if ($questionId > 0) {
                $result = [
                    'ok' => true,
                    'questions' => $this->questionRepository->findQuestionsByGameId($gameId)->toArray()
                ];
            }
        } else {
            $result = [
                'ok' => false,
                'error' => 'Game ID or question is missing.'
            ];
        }
        
        return JsonResponseFactory::create($result);
    }

    /**
     * getAnswer
     *
     * @param string $answer
     * @return integer
     */
    private function getAnswer(string $answer): int
    {
        $result = -1;
        if (strtolower(trim($answer)) === 'yes') {
            $result = 1;
        } elseif (strtolower(trim($answer)) === 'no') {
            $result = 0;
        }
        return $result;
    }
}
