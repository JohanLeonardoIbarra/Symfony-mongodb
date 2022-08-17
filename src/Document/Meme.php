<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

#[MongoDB\Document]
class Meme
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
