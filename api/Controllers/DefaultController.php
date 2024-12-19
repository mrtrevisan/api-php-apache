<?php

namespace Controllers;

use Utils\Request;
use Utils\Response;

class DefaultController
{
    protected static function notFound(Response $res)
    {
        $res->setCode(404);
        $res->setData([
            'error' => "Method not Found"
        ]);
        
        return;
    }

    protected static function badRequest(Response $res)
    {
        $res->setCode(400);
        $res->setData([
            'error' => "Bad Request"
        ]);
        
        return;
    }

    protected static function invalidMethod(Response $res)
    {
        $res->setCode(400);
        $res->setData([
            'error' => "Invalid Method"
        ]);
        
        return;
    }
}