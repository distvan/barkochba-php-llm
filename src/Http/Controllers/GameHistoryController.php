<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Contracts\GameRepository;
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
        private GameRepository $gameRepository
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
        return JsonResponseFactory::create($this->gameRepository->findHighestScoredGames()->toArray());
    }
}
