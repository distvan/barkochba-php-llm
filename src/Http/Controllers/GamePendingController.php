<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Contracts\GameRepository;
use App\Domain\Contracts\QuestionRepository;
use App\Domain\Contracts\Storage as StorageInterface;
use App\Shared\Http\JsonResponseFactory;
use Psr\Http\Message\ResponseInterface;

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
     * @param StorageInterface $storage
     */
    public function __construct(
        private GameRepository $gameRepository,
        private QuestionRepository $questionRepository,
        private StorageInterface $storage
    ) {
    }

    public function __invoke(): ResponseInterface
    {
        $defaultUser = 1;
        $game = $this->gameRepository->getLatestUnfinishedGame($defaultUser);
        $questionCollection = $this->questionRepository->findQuestionsByGameId($game->getId());
        $this->storage->save('game_id', $game->getId());
        $this->storage->save('target_word', $game->getTargetWord());
        $result = [
            'result' => [
                'category' => $game->getCategory(),
                'questions' => $questionCollection->toArray()
            ]
        ];
        return JsonResponseFactory::create($result);
    }
}
