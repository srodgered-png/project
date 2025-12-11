<?php
namespace App\Controller;

use App\Service\Request;
use App\Repository\PositionRepository;
use PDO;

class DefaultController extends AbstractController
{
    public function index(PDO $pdo, PositionRepository $pr): string
    {
        $positions = $pr->getPositions($pdo);
        return $this->render('index.php', [
            'positions' => $positions
        ]);
    }
}