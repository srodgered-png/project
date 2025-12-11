<?php

namespace App\Model;

final class User
{
    private $id;
    private $first_name;
    private $last_name;
    private $id_position;
    private $position;

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function getFirstName(): ?string {
        return $this->first_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setIdPosition(int $id_position): self
    {
        $this->id_position = $id_position;
        return $this;
    }

    public function getIdPosition(): ?int
    {
        return $this->id_position;
    }

    public function setPosition(Position $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }
}