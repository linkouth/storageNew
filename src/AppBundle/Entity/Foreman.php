<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 21.07.18
 * Time: 10:55
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Foreman
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class Foreman extends User
{
    /**
     * @var ArrayCollection|Loader[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Loader", mappedBy="foreman")
     *
     * @Assert\NotBlank(message="Выберите грузчиков смены")
     */
    protected $loaders;

    /**
     * Foreman constructor.
     */
    public function __construct()
    {
        $this->loaders = new ArrayCollection();
    }

    public function getRole()
    {
        return 'ROLE_USER';
    }

    /**
     * @return Loader[]|ArrayCollection
     */
    public function getLoaders()
    {
        return $this->loaders;
    }

    /**
     * @param Loader[]|ArrayCollection $loaders
     */
    public function setLoaders($loaders)
    {
        $this->loaders = $loaders;
    }

    public function __toString()
    {
        return $this->getId().' '.$this->getName().' '.$this->getSurname();
    }

}