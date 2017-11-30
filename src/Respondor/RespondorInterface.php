<?php

namespace UWDOEM\REST\Backend\Respondor;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


interface RespondorInterface
{
    public function __invoke(Request $request, Response $response);
}