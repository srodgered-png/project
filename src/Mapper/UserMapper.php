<?php

namespace App\Mapper;

use App\Model\User;

final class UserMapper
{
    public function userToArray(User $user) {
        $data = [
            'id'          => $user->getId(),
            'first_name'  => $user->getFirstName(),
            'last_name'   => $user->getLastName(),
            'id_position' => $user->getIdPosition()
        ];

        $position = $user->getPosition();
        if ($position) {
            $data['position'] = [
                'id'   => $position->getId(),
                'name' => $position->getName()
            ];
        }

        return $data;
    }

    public function userToJson(User $user): string
    {
        return json_encode($this->userToArray($user));
    }

    public function userListToJson(array $users): string {
        $userList = array_map(function($user) {
            return $this->userToArray($user);
        }, $users);

        return json_encode($userList);
    }
}