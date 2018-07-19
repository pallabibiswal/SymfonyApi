<?php

namespace AppBundle\EventListener;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class RequestListener
 * @package AppBundle\EventListener
 */
class ResponseListener
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ResponseListener constructor.
     * @param ContainerInterface $container
     * @param LoggerInterface $log
     */
    public function __construct(ContainerInterface $container, LoggerInterface $log)
    {
        $this->container = $container;
        $this->logger = $log;
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getRequest();
        $headers = $request->headers->all();
        $response = $event->getResponse();
        $this->logger->info('Request : '.
            json_encode($request->getContent()).PHP_EOL.'Headers :' .
            json_encode($headers).PHP_EOL.'Response :'.json_encode($response->getContent()).PHP_EOL
        );
    }
}