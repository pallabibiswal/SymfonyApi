<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Device;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Merchant
 *
 * @ORM\Table(name="merchant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MerchantRepository")
 */
class Merchant
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
     * @ORM\Column(name="mid", type="string", length=15, nullable=true, unique=true)
     */
    private $mid;

    /**
     * @var string
     *
     * @ORM\Column(name="business_name", type="string", length=100, nullable=true)
     */
    private $businessName;

    /**
     * @var Device
     *
     * @ORM\OneToMany(targetEntity="Device", mappedBy="merchantId")
     */
    private $device;

    /**
     * @return \AppBundle\Entity\Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param \AppBundle\Entity\Device $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * Merchant constructor.
     */
    public function __construct()
    {
        $this->device = new ArrayCollection();
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
     * Set mid
     *
     * @param string $mid
     *
     * @return Merchant
     */
    public function setMid($mid)
    {
        $this->mid = $mid;

        return $this;
    }

    /**
     * Get mid
     *
     * @return string
     */
    public function getMid()
    {
        return $this->mid;
    }

    /**
     * Set businessName
     *
     * @param string $businessName
     *
     * @return Merchant
     */
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;

        return $this;
    }

    /**
     * Get businessName
     *
     * @return string
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }
}

