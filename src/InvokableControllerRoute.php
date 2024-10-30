<?php

namespace BlankFramework\InvokableControllerRoute;

use BlankFramework\InvokableControllerRoute\Interfaces\InvokableControllerContainerInterface;
use BlankFramework\RoutingInterfaces\RouteInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @property class-string<InvokableControllerContainerInterface> $getControllerContainer
 * @property class-string<InvokableControllerContainerInterface> $postControllerContainer
 * @property class-string<InvokableControllerContainerInterface> $putControllerContainer
 * @property class-string<InvokableControllerContainerInterface> $deleteControllerContainer
 * @property class-string<InvokableControllerContainerInterface> $patchControllerContainer
 * @property class-string<InvokableControllerContainerInterface> $headControllerContainer
 * @property class-string<InvokableControllerContainerInterface> $optionsControllerContainer
 * @property class-string<InvokableControllerContainerInterface> $connectControllerContainer
 * @property class-string<InvokableControllerContainerInterface> $traceControllerContainer
 */
class InvokableControllerRoute implements RouteInterface
{
    /**
     * @param class-string<InvokableControllerContainerInterface> $getControllerContainer
     * @param class-string<InvokableControllerContainerInterface> $postControllerContainer
     * @param class-string<InvokableControllerContainerInterface> $putControllerContainer
     * @param class-string<InvokableControllerContainerInterface> $deleteControllerContainer
     * @param class-string<InvokableControllerContainerInterface> $patchControllerContainer
     * @param class-string<InvokableControllerContainerInterface> $headControllerContainer
     * @param class-string<InvokableControllerContainerInterface> $optionsControllerContainer
     * @param class-string<InvokableControllerContainerInterface> $connectControllerContainer
     * @param class-string<InvokableControllerContainerInterface> $traceControllerContainer
     * @throws \InvalidArgumentException
     */
    public function __construct(
        private ?string $getControllerContainer = null,
        private ?string $postControllerContainer = null,
        private ?string $putControllerContainer = null,
        private ?string $deleteControllerContainer = null,
        private ?string $patchControllerContainer = null,
        private ?string $headControllerContainer = null,
        private ?string $optionsControllerContainer = null,
        private ?string $connectControllerContainer = null,
        private ?string $traceControllerContainer = null,
    ) {
        if (
            $this->getControllerContainer !== null
            && !($this->getControllerContainer instanceof InvokableControllerContainerInterface)
        ) {
            throw new \InvalidArgumentException('GET controller class must be an instance of InvokableControllerContainerInterface');
        }
        if (
            $this->postControllerContainer !== null
            && !($this->postControllerContainer instanceof InvokableControllerContainerInterface)
        ) {
            throw new \InvalidArgumentException('POST controller class must be an instance of InvokableControllerContainerInterface');
        }
        if (
            $this->putControllerContainer !== null
            && !($this->putControllerContainer instanceof InvokableControllerContainerInterface)
        ) {
            throw new \InvalidArgumentException('PUT controller class must be an instance of InvokableControllerContainerInterface');
        }
        if (
            $this->deleteControllerContainer !== null
            && !($this->deleteControllerContainer instanceof InvokableControllerContainerInterface)
        ) {
            throw new \InvalidArgumentException('DELETE controller class must be an instance of InvokableControllerContainerInterface');
        }
        if (
            $this->patchControllerContainer !== null
            && !($this->patchControllerContainer instanceof InvokableControllerContainerInterface)
        ) {
            throw new \InvalidArgumentException('PATCH controller class must be an instance of InvokableControllerContainerInterface');
        }
        if (
            $this->headControllerContainer !== null
            && !($this->headControllerContainer instanceof InvokableControllerContainerInterface)
        ) {
            throw new \InvalidArgumentException('HEAD controller class must be an instance of InvokableControllerContainerInterface');
        }
        if (
            $this->optionsControllerContainer !== null
            && !($this->optionsControllerContainer instanceof InvokableControllerContainerInterface)
        ) {
            throw new \InvalidArgumentException('OPTIONS controller class must be an instance of InvokableControllerContainerInterface');
        }
        if (
            $this->connectControllerContainer !== null
            && !($this->connectControllerContainer instanceof InvokableControllerContainerInterface)
        ) {
            throw new \InvalidArgumentException('CONNECT controller class must be an instance of InvokableControllerContainerInterface');
        }
        if (
            $this->traceControllerContainer !== null
            && !($this->traceControllerContainer instanceof InvokableControllerContainerInterface)
        ) {
            throw new \InvalidArgumentException('TRACE controller class must be an instance of InvokableControllerContainerInterface');
        }
    }

    public function handleRequest(RequestInterface $request): ResponseInterface
    {
        $controllerClassName = match (strtolower($request->getMethod())) {
            'get' => $this->getControllerContainer,
            'post' => $this->postControllerContainer,
            'put' => $this->putControllerContainer,
            'delete' => $this->deleteControllerContainer,
            'patch' => $this->patchControllerContainer,
            'head' => $this->headControllerContainer,
            'options' => $this->optionsControllerContainer,
            'connect' => $this->connectControllerContainer,
            'trace' => $this->traceControllerContainer,
            default => null,
        };

        if ($controllerClassName === null) {
            throw new \Exception('Invalid request method');
        }

        $controller = $controllerClassName::make();

        return $controller($request);
    }
}
