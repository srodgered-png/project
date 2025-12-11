<?php

namespace App\Form;

use App\Model\User;

final class UserForm
{
    private $id;
    private $first_name;
    private $last_name;
    private $id_position;

    private array $errors = [];

    public function __construct(array $data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['first_name'])) {
            $this->first_name = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $this->last_name = $data['last_name'];
        }
        if (isset($data['position'])) {
            $this->id_position = $data['position'];
        }
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function errorsToJson(): string {
        return json_encode(['errors' => $this->errors]);
    }

    public function validate() {
        $strlenFirstName = strlen($this->first_name);
        if ($strlenFirstName < 3) {
            $this->errors[] = 'The first name length must be more than 3 characters.';
        }
        if ($strlenFirstName > 20) {
            $this->errors[] = 'The first name length should not exceed 20 characters.';
        }

        $strlenLastName = strlen($this->last_name);
        if ($strlenLastName < 3) {
            $this->errors[] = 'The last name length must be more than 3 characters.';
        }
        if ($strlenLastName > 20) {
            $this->errors[] = 'The last name length should not exceed 20 characters.';
        }

        return $this->errors ? false : true;
    }

    public function apply(User $user): void {
        if ($this->id) {
            $user->setId($this->id);
        }

        $user->setFirstName($this->first_name);
        $user->setLastName($this->last_name);
        $user->setIdPosition($this->id_position);
    }
}