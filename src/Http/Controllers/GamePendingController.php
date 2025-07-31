<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Contracts\GameRepository;
use App\Domain\Contracts\QuestionRepository;
use App\Shared\Http\JsonResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * GameController
 *
 * @package App\Http\Controllers
 */
class GamePendingController
{
    /**
     * Constructor
     *
     * @param GameRepository $gameRepository
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        private GameRepository $gameRepository,
        private QuestionRepository $questionRepository
    ) {
    }

    public function __invoke(): ResponseInterface
    {
        $defaultUser = 1;
        $game = $this->gameRepository->getLatestUnfinishedGame($defaultUser);
        $questionCollection = $this->questionRepository->findQuestionsByGameId($game->getId());
        $result = [
            'result' => [
                'category' => $game->getCategory(),
                'questions' => $questionCollection->toArray()
            ]
        ];
        return JsonResponseFactory::create($result);
    }
}
