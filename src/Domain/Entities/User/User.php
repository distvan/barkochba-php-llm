<?php

declare(strict_types=1);

namespace App\Domain\Entities\User;

/**
 * User Entity Class
 *
 * @package App\Domain\Entities
 * @author  Istvan Dobrentei <info@dobrenteiistvan.hu>
 * @link    https://www.en.dobrenteiistvan.hu
 */
class User
{
    /**
     * Constructor
     *
     * @param integer $id
     * @param string $name
     */
    public function __construct(
        private int $id,
        private string $name
    ) {
    }

    /**
     * getId
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * getName
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
