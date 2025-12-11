<?php

namespace App\Service;

class Request {

    private string $url;
    private string $method   = 'GET';
    private array  $get      = [];
    private array  $post     = [];
    private array  $contents = [];

    public function __construct()
    {
        $this->url    = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->get    = $_GET ?? [];
        $this->post   = $_POST ?? [];

        $input = file_get_contents('php://input');

        if (!empty($input)) {
            $data = json_decode($input, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                $this->contents = $data;
            }
        }
    }

    public function method(): string {
        return $this->method;
    }

    public function get(): array {
        return $this->get;
    }

    public function post(): array {
        return $this->post;
    }

    public function contents(): array {
        return $this->contents;
    }

    public function getUrl() {
        return $this->url;
    }
}