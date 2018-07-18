<?php

namespace AppBundle\EventListener;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class RequestListener
 * @package AppBundle\EventListener
 */
class RequestListener
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var
     */
    private $logger;

    /**
     * RequestListener constructor.
     * @param ContainerInterface $container
     * @param LoggerInterface $log
     */
    public function __construct(ContainerInterface $container, LoggerInterface $log)
    {
        $this->container = $container;
        $this->logger = $log;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $content = $request->getContent();
        $headers = $request->headers->all();
        $this->logger->info('Request Content :'. json_encode($content));
        $this->logger->info('Request Header :'. json_encode($headers));
    }
}