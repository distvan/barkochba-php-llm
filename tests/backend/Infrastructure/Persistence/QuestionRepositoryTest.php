<?php

namespace Tests\backend\Infrastructure\Persistence;

use App\Domain\Game\QuestionCollection;
use App\Infrastructure\Persistence\QuestionRepository;
use Tests\backend\BaseTestCase;

class QuestionRepositoryTest extends BaseTestCase
{
    public function testFindQuestionsByGameIdWhenExists(): void
    {
        $repository = new QuestionRepository($this->pdo);
        $collection = $repository->findQuestionsByGameId(1);
        $this->assertInstanceOf(QuestionCollection::class, $collection);
        $this->assertEquals(1, $collection->count());
        foreach ($collection as $question) {
            $this->assertEquals('Is it live beeing?', $question->getQuestion());
            $this->assertEquals(1, $question->getGameId());
            $this->assertFalse($question->getAnswer());
        }
    }

    public function testFindQuestionsByGameIdAtEmptyResult(): void
    {
        $repository = new QuestionRepository($this->pdo);
        $collection = $repository->findQuestionsByGameId(100);
        $this->assertInstanceOf(QuestionCollection::class, $collection);
        $this->assertEquals(0, $collection->count());
    }
}
