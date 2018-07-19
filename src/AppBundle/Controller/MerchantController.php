<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use AppBundle\Entity\Merchant;
use AppBundle\Services\ProcessApiRequest;

/**
 * Class MerchantController
 * @package AppBundle\Controller
 */
class MerchantController extends FOSRestController
{
    /**
     * @var object
     */
    private $process;

    /**
     * MerchantController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->process = $container->get('service_api_processing');
    }

    /**
     * @Get("/api/merchant/{mid}")
     */
    public function getOneMerchant($mid)
    {
        $merchant = $this->process->getOneMerchant($mid);
        return $merchant;
    }

    /**
     * @Get("/api/all/merchant")
     */
    public function getAllMerchant()
    {
        $merchants = $this->process->getAllMerchantRequest();
        return $merchants;
    }

    /**
     * @Post("/api/create/merchant")
     * @param Request $request
     * @return mixed
     */
    public function createNewMerchant(Request $request)
    {
        $request = $request->getContent();
        $this->process->createMerchant($request);

        return $this->process->successMerchantResponse('create');
    }

    /**
     * @Put("/api/update/merchant")
     * @param Request $request
     * @return mixed
     */
    public function updateMerchant(Request $request)
    {
        $request = $request->getContent();
        $this->process->updateMerchant($request);

        return $this->process->successMerchantResponse('update');
    }

    /**
     * @Delete("/api/delete/merchant")
     * @param Request $request
     * @return mixed
     */
    public function deleteMerchant(Request $request)
    {
        $request = $request->getContent();
        $this->process->deleteMerchant($request);

        return $this->process->successMerchantResponse('delete');
    }
}