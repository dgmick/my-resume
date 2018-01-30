<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * professional_status
 *
 * @ORM\Table(name="professional_status")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\professional_statusRepository")
 */
class professional_status
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
     * @ORM\Column(name="introduction", type="text")
     */
    private $introduction;

    /**
     * @var string
     *
     * @ORM\Column(name="status_Job", type="string", length=255)
     */
    private $statusJob;


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
     * Set statusJob
     *
     * @param string $statusJob
     *
     * @return professional_status
     */
    public function setStatusJob($statusJob)
    {
        $this->statusJob = $statusJob;

        return $this;
    }

    /**
     * Get statusJob
     *
     * @return string
     */
    public function getStatusJob()
    {
        return $this->statusJob;
    }

    /**
     * Set introduction
     *
     * @param string $introduction
     *
     * @return professional_status
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;

        return $this;
    }

    /**
     * Get introduction
     *
     * @return string
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }
}
