<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Contracts\UserRepository as UserRepositoryInterface;
use App\Domain\Entities\User\NullUser;
use App\Domain\Entities\User\User;
use App\Domain\Shared\Factory\NullObjectFactory;
use PDO;

/**
 * UserRepository class
 *
 * @package App\Infrastructure\Persistence
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * Constructor
     *
     * @param PDO $pdo
     */
    public function __construct(private PDO $pdo) {}

    /**
     * findById
     *
     * @param integer $userId
     * @return User
     */
    public function findById(int $userId): User|NullUser
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id=:user_id');
        $stmt->execute(['user_id' => $userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            return NullObjectFactory::get(NullUser::class);
        }
        
        return new User($row['id'], $row['name']);
    }
}
