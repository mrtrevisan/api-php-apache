<?php

namespace Utils;

class Request
{
    // armazena dados mais acessado da requisição
    // método (GET, POST, PUT, DELETE, ...)
    // url original
    // parâmetros extraídos da url (array)
    // query string (GET)
    // e body (POST e PUT)
    public string $method = "";
    public string $url = "";
    public array $params = [];
    public array $query = [];
    public array $body = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->url = $_SERVER['REQUEST_URI'];

        $parsedUrl = parse_url($this->url);

        $this->params = explode('/', trim($parsedUrl['path'], '/'));
        parse_str($parsedUrl['query'] ?? "", $this->query);

        $rawBody = file_get_contents('php://input');
        $this->body = json_decode($rawBody, true) ?? [];
    }
}
