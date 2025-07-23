<?php

namespace Tests\backend\Infrastructure\Persistence;

use App\Domain\Entities\User\NullUser;
use App\Domain\Entities\User\User;
use App\Infrastructure\Persistence\UserRepository;
use Tests\backend\Infrastructure\Persistence\DatabaseTestCase;

class UserRepositoryTest extends DatabaseTestCase
{
    public function testFindByUserIdWhenUserExist(): void
    {
        $repository = new UserRepository($this->pdo);
        $user = $repository->findById(1);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Test', $user->getName());
    }

    public function testFindByUserIdWhenUserDoesNotExist(): void
    {
        $repository = new UserRepository($this->pdo);
         /** @var NullUser */
        $nullUser = $repository->findById(100);
        $this->assertInstanceOf(NullUser::class, $nullUser);
        $this->assertTrue($nullUser->isNull());
    }
}
