<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Contracts\GameRepository;
use App\Domain\Contracts\Storage;
use App\Shared\Http\JsonResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * GameController
 *
 * @package App\Http\Controllers
 */
class GameController
{
    /**
     * Constructor
     *
     * @param GameRepository $gameRepository
     */
    public function __construct(
        private GameRepository $gameRepository,
        private Storage $storage
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
        $defaultUser = 1;
        $category =  isset($request->getParsedBody()['category']) ? (string)$request->getParsedBody()['category'] : '';
        $result = ['result' => ''];
        $gameId = (int)$this->gameRepository->createNewGame($defaultUser, $category);
        if ($gameId) {
            $this->storage->save('game_id', $gameId);
            $result['result'] = 'started';
        }
        return JsonResponseFactory::create($result);
    }
}
