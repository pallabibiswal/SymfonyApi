<?php

namespace AppBundle\Services;

use AppBundle\Entity\Merchant;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class ProcessApiRequest
 * @package AppBundle\Services
 */
class ProcessApiRequest
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ProcessApiRequest constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * @return array
     */
    public function getAllMerchantRequest()
    {
        $merchant = $this->entityManager->getRepository('AppBundle:Merchant')->findAll();
        return $merchant;
    }

    /**
     * @param $contents
     * @return int
     * @throws \Exception
     */
    public function createMerchant($contents)
    {
        try {
            $mandatory = ['mid', 'business_name'];
            $request_array = json_decode($contents, true);
            $requestData = $this->requiredParameterCheck($mandatory, $request_array);
            $foundMerchant = $this->entityManager->getRepository('AppBundle:Merchant')->findOneBy(
                array('mid' => $requestData['mid'])
            );

            if (!empty($foundMerchant)) {
                throw new Exception("Merchant Exist");
            }

            $merchant = new Merchant();
            $merchant->setMid($requestData['mid']);
            $merchant->setBusinessName($requestData['business_name']);
            $this->entityManager->persist($merchant);
            $this->entityManager->flush($merchant);

            if (empty($merchant->getId())) {
                throw new Exception("Can not create Merchant");
            }

            return $merchant->getId();

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * @param $request
     * @throws \Exception
     */
    public function updateMerchant($request)
    {
        try {
            $mandatory = ['mid'];
            $request_array = json_decode($request, true);
            $requestData = $this->requiredParameterCheck($mandatory, $request_array);
            $merchant = $this->entityManager->getRepository('AppBundle:Merchant')->findOneBy(array('mid' => $requestData['mid']));

            if (empty($merchant) || empty($merchant->getId())) {
                throw new Exception("Merchant Does not exist");
            } elseif (!array_key_exists('business_name', $requestData)) {
                throw new Exception("No Business name to Update");
            }

            $merchant->setBusinessName($requestData['business_name']);
            $this->entityManager->persist($merchant);
            $this->entityManager->flush($merchant);

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * @param string $mid
     * @return null|object
     * @throws \Exception
     */
    public function getOneMerchant($mid = '')
    {
        try {
            if (empty($mid)) {
                throw new Exception("Empty mid value");
            }
            $merchant = $this->entityManager->getRepository('AppBundle:Merchant')->findOneBy(array('mid' => $mid));

            if (empty($merchant) || empty($merchant->getId())) {
                throw new Exception("Merchant Does not exist");
            }

            return $merchant;

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * @param $request
     * @throws \Exception
     */
    public function deleteMerchant($request)
    {
        $request_array = json_decode($request, true);
        $mandatory = ['mid'];
        $requestData = $this->requiredParameterCheck($mandatory, $request_array);

        $merchant = $this->entityManager->getRepository('AppBundle:Merchant')->findOneBy(array('mid' => $requestData['mid']));

        if (empty($merchant) || empty($merchant->getId())) {
            throw new Exception("Merchant Does not exist");
        }

        $this->entityManager->remove($merchant);
        $this->entityManager->flush();
    }

    /**
     * @param $required_param
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function requiredParameterCheck($required_param, $request)
    {
        try {
            foreach ( $required_param as $parameters ) {
                if (!array_key_exists($parameters, $request)) {
                    throw new Exception("Required parameter is missing :". $parameters);
                } elseif (empty($request[$parameters])) {
                    throw new Exception("Empty Value :". $parameters);
                }
                $request[$parameters] = trim($request[$parameters]);
            }
            return $request;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * @param $type
     * @return mixed
     * @throws \Exception
     */
    public function successMerchantResponse($type)
    {
        try {
            $successResponse = [
                'create' => [
                    'Success' => 'true',
                    'Text' => 'Merchant Created Successfully',
                ],
                'update' => [
                    'Success' => 'true',
                    'Text' => 'Merchant Updated Successfully',
                ],
                'delete' => [
                    'Success' => 'true',
                    'Text' => 'Merchant Deleted Successfully',
                ],
            ];

            if (array_key_exists($type, $successResponse)) {
                return $successResponse[$type];
            }
            throw new Exception("Something went wrong");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}