<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Merchant;

/**
 * Class MerchantController
 * @package AppBundle\Controller
 */
class MerchantController extends FOSRestController
{
    /**
     * @Rest\Get("/merchant")
     */
    public function getAllMerchant()
    {
        $merchant =
            $this->getDoctrine()->getRepository('AppBundle:Merchant')->findAll();

        return $merchant;
    }
}