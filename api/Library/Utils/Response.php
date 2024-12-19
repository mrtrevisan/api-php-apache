<?php

namespace Utils;

class Response
{
    // objeto para armazenar dados do Response
    // código (200, 400, 404, 500, ...)
    // dados de retorno (payload ou mensagens de erro)
    public string $code = "";
    public array $data = [];

    public function __construct()
    {
        return;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
