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
     * @var LoggerInterface
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
     * @return bool
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $routePath = $request->getPathInfo();
        if (0 !== strpos('api', $routePath)) {
            return true;
        }

        $auth = $this->container->get('service_api_authenticaton');
        return $auth->authCheck($request);
    }
}