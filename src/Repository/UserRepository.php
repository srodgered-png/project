<?php

namespace App\Repository;

use App\Model\User;
use App\Model\Position;
use PDO;

class UserRepository {

    public function findUserById(PDO $pdo, int $id): User
    {
        $user = new User();
        if (!$id) {
            return $user;
        }

        $sql = 'SELECT id, first_name, last_name, id_position FROM user WHERE id = :id LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = new User();
        if (!$row) {
            return $user;
        }

        $user
            ->setId((int)$row['id'])
            ->setFirstName($row['first_name'])
            ->setLastName($row['last_name'])
            ->setIdPosition((int)$row['id_position']);

        return $user;
    }

    public function getUsers(PDO $pdo): array
    {
        $sql = 'SELECT u.id, u.first_name, u.last_name, u.id_position, p.id AS p_id, p.name AS p_name FROM user AS u LEFT JOIN position AS p ON p.id = u.id_position';
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $position = new Position();
            $position->setId((int)$row['p_id']);
            $position->setName($row['p_name']);

            $user = new User();
            $user
                ->setId((int)$row['id'])
                ->setFirstName($row['first_name'])
                ->setLastName($row['last_name'])
                ->setIdPosition((int)$row['id_position'])
                ->setPosition($position);

            $users[] = $user;
        }

        return $users;
    }

    public function createUser(PDO $pdo, User $user): User {
        $sql = 'INSERT INTO user (first_name, last_name, id_position) VALUES (:first_name, :last_name, :id_position)';
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'first_name'  => $user->getFirstName(),
            'last_name'   => $user->getLastName(),
            'id_position' => $user->getIdPosition(),
        ]);

        $user->setId((int)$pdo->lastInsertId());

        return $user;
    }

    public function updateUser(PDO $pdo, User $user): User {
        $sql = 'UPDATE user SET first_name = :first_name, last_name = :last_name, id_position = :id_position WHERE id = :id';
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'id'          => $user->getId(),
            'first_name'  => $user->getFirstName(),
            'last_name'   => $user->getLastName(),
            'id_position' => $user->getIdPosition(),
        ]);

        return $user;
    }

    public function deleteUser(PDO $pdo, User $user): User {
        $sql = 'DELETE FROM user WHERE id = :id';
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'id' => $user->getId()
        ]);

        return $user;
    }
}