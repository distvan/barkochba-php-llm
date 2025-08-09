<?php

namespace Tests\backend\Helpers;

use PHPUnit\Framework\MockObject\MockObject;

trait MockingTrait
{
    /**
     * Create a mock object for the given class name.
     * @template T
     * @param string<T> $className
     * @return MockObject@T
     */
    protected function mock(string $className)
    {
        return $this->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
