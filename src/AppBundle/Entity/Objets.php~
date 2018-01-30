<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Objets
 *
 * @ORM\Table(name="objets")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObjetsRepository")
 */
class Objets
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
     *@Assert\NotBlank(message="Choisiez un Sujet")
     * @ORM\Column(name="Objets", type="string", length=50)
     */
    private $objets;



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
     * Set objets
     *
     * @param string $objets
     *
     * @return Objets
     */
    public function setObjets($objets)
    {
        $this->objets = $objets;

        return $this;
    }

    /**
     * Get objets
     *
     * @return string
     */
    public function getObjets()
    {
        return $this->objets;
    }

    public function __toString()
    {
        return (string) $this->getObjets();
    }
}
