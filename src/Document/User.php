<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

/**
 * @MongoDB\Document(
 *     db="test",
 *     collection="users"
 * )
*/
class User{
    /** @MongoDB\Id */
    private $id;
    /** @MongoDB\Field(type="string") */
    private $name;
    /** @MongoDB\Field(type="string") */
    private $surname;

    /**
     * @param $name
     * @param $surname
     */
    public function __construct($name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    public function toString(): string
    {
        return "Id: $this->id, Name: $this->name, Surname: $this->surname";
    }
}