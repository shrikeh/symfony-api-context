<?php

declare(strict_types=1);

namespace Shrikeh\ApiContext\Http\EventListener;

use Psr\Http\Message\ResponseInterface;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;

final readonly class Psr7Response
{
    public function __construct(private HttpFoundationFactoryInterface $httpFoundationFactory)
    {
    }

    public function __invoke(ViewEvent $viewEvent): void
    {
        if ($viewEvent->hasResponse()) {
            return;
        }

        $result = $viewEvent->getControllerResult();

        if ($result instanceof ResponseInterface) {
            $viewEvent->setResponse($this->httpFoundationFactory->createResponse($result));
        }
    }
}
