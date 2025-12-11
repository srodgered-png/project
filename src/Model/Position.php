<?php

namespace App\Model;

final class Position
{
    private $id;
    private $name;

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }
}