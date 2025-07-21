<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Contracts\UserRepository as UserRepositoryInterface;
use App\Domain\Entities\User;
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

}