<?php
namespace App\Controller;

abstract class AbstractController
{

    public function render(string $template, array $values): string
    {
        extract($values, EXTR_SKIP);
        ob_start();
        include_once('../src/View/' . $template);
        return ob_get_clean();
    }

}