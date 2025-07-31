<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Contracts\GameRepository;
use App\Domain\Contracts\UserRepository;
use App\Shared\Http\JsonResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * GameHistoryController
 *
 * @package App\Http\Controllers
 */
class GameHistoryController
{
    /**
     * Constructor
     *
     * @param GameRepository $gameRepository
     */
    public function __construct(
        private GameRepository $gameRepository,
        private UserRepository $userRepository
    ) {
    }

    /**
     * Return game history of latest game result
     *
     * __invoke
     *
     * @param ServerRequestInterface $request
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $result = [];
        $collection = $this->gameRepository->findHighestScoredGames();
        foreach ($collection->getIterator() as $item) {
            $user = $this->userRepository->findById($item->getUserId());
            $result[] = [
                'name' => $user->getName(),
                'start' => $item->getStartDate(),
                'end' => $item->getEndDate(),
                'score' => $item->getScore()
            ];
        }
        return JsonResponseFactory::create($result);
    }
}
