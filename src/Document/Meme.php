<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

#[MongoDB\Document(db: "test", collection: "memes")]
class Meme{
    #[MongoDB\Id]
    private $id;
    #[MongoDB\Field(type: Type::STRING)]
    private $path;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}