<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Merchant;

/**
 * Device
 *
 * @ORM\Table(name="device")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DeviceRepository")
 */
class Device
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tid", type="string", length=10, nullable=true, unique=true)
     */
    private $tid;

    /**
     * @var string
     *
     * @ORM\Column(name="device_type", type="string", length=30, nullable=true)
     */
    private $deviceType;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Merchant", inversedBy="device")
     * @ORM\JoinColumn(name="merchant_id", onDelete="CASCADE")
     */
    private $merchantId;

    /**
     * @return Merchant
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param Merchant $merchantId
     * @return Merchant
     */
    public function setMerchantId(Merchant $merchantId)
    {
        $this->merchantId = $merchantId;

        return $this;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tid
     *
     * @param string $tid
     *
     * @return Device
     */
    public function setTid($tid)
    {
        $this->tid = $tid;

        return $this;
    }

    /**
     * Get tid
     *
     * @return string
     */
    public function getTid()
    {
        return $this->tid;
    }

    /**
     * Set deviceType
     *
     * @param string $deviceType
     *
     * @return Device
     */
    public function setDeviceType($deviceType)
    {
        $this->deviceType = $deviceType;

        return $this;
    }

    /**
     * Get deviceType
     *
     * @return string
     */
    public function getDeviceType()
    {
        return $this->deviceType;
    }
}

