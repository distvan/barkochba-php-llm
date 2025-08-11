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
class GameEndController
{
    public function __construct(
        private GameRepository $gameRepository,
        private Storage $storage
    ) {
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $result = ['result' => ''];
        $guessedWord =  isset($request->getParsedBody()['guessedWord']) ? (string)$request->getParsedBody()['guessedWord'] : '';
        $gameId = (int)$this->storage->load('game_id');
        if ($gameId && $this->storage->load('target_word') === $guessedWord) {
            $this->gameRepository->endGame($gameId, 1);
            $result = [
                'ok' => true,
                'message' => 'Congratulations! You guessed the word.',
                'gameId' => $gameId
            ];
        }
        return JsonResponseFactory::create($result);
    }
}
