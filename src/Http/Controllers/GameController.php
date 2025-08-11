<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Contracts\AIAssistant;
use App\Domain\Contracts\GameRepository;
use App\Domain\Contracts\Storage;
use App\Domain\Shared\Category\CategoryEnum;
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
     * @param Storage $storage
     * @param AIAssistant $aiAssistant
     */
    public function __construct(
        private GameRepository $gameRepository,
        private Storage $storage,
        private AIAssistant $aiAssistant
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
        if (!GameController::isValidCategory($category)) {
            return JsonResponseFactory::create(['error' => 'Invalid category'], 400);
        }
        $gameId = (int)$this->gameRepository->createNewGame($defaultUser, $category, $this->aiAssistant->suggestWord($category, $_ENV['AI_ASSISTANT_MODEL']));
        if ($gameId) {
            $this->storage->save('game_id', $gameId);
            $result['result'] = 'started';
        }
        return JsonResponseFactory::create($result);
    }

    private static function isValidCategory($category): bool
    {
        return CategoryEnum::tryFrom($category) !== null;
    }
}
