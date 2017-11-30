<?php

namespace UWDOEM\REST\Backend\Respondor;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

interface RespondorInterface
{

    /**
     * @param Request  $request
     * @param Response $response
     * @return mixed
     */
    public function __invoke(Request $request, Response $response);
}
