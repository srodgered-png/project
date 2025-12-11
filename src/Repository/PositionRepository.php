<?php

namespace App\Repository;

use App\Model\Position;

class PositionRepository {

    public function getPositions(\PDO $pdo): array
    {
        $sql = 'SELECT id, name FROM position';
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $positions = [];
        foreach ($rows as $row) {
            $position = new Position();
            $position
                ->setId((int)$row['id'])
                ->setName($row['name']);
            $positions[] = $position;
        }

        return $positions;
    }
}