<?php

namespace App\Entity;

use App\Repository\UserSQLRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSQLRepository::class)]
class UserSQL
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 250)]
    private ?string $phone = null;

    /**
     * @param string|null $name
     * @param string|null $surname
     * @param string|null $phone
     */
    public function __construct(?string $name = "", ?string $surname = "", ?string $phone = "")
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function toString(): string
    {
        return "name: $this->name, surname: $this->surname, phone: $this->phone";
    }
}
