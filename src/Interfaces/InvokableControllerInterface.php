<?php

namespace BlankFramework\InvokableControllerRoute\Interfaces;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface InvokableControllerInterface
{
    public function __invoke(RequestInterface $request): ResponseInterface;
}
