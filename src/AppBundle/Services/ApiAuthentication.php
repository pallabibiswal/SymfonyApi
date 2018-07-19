<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;


/**
 * Class ApiAuthentication
 * @package AppBundle\Services
 */
class ApiAuthentication
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var string
     */
    private $secretKey = 'jhTvd34SDhfhe';

    /**
     * @var string
     */
    private $username = 'reddotwcauth';

    /**
     * ApiAuthentication constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * @param $request
     * @return bool
     * @throws \Exception
     */
    public function authCheck($request)
    {
        try{
            $headers = $request->headers->all();
            $verb = $request->getMethod();

            if (!array_key_exists('authorization', $headers)) {
                throw new Exception('Header Parameter Missing :  authorization');
            }

            $hash = sha1($this->secretKey);
            $serverAuthCode = base64_encode(hash_hmac('sha1', $verb, $hash));
            $serverAuthorisation = 'RDN-CRM '.$this->username.':' . $serverAuthCode;

            if ($headers['authorization'][0] !== $serverAuthorisation) {
                throw new Exception('Unauthorised Access');
            }

        } catch (\Exception $ex) {
            throw $ex;
        }

        return true;
    }
}