<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 04.08.18
 * Time: 21:43
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Shift
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="shifts")
 */
class Shift
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     *
     * @Assert\NotBlank(message="Выберите дату")
     */
    protected $date;

    /**
     * @var Foreman
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Foreman")
     *
     * @Assert\NotBlank(message="Выберите прораба смена")
     */
    protected $foreman;

    /**
     * @var ArrayCollection|Loader[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Loader")
     *
     * @Assert\NotBlank(message="Выберите грузчиков смены")
     */
    protected $loaders;

    /**
     * Shift constructor.
     */
    public function __construct()
    {
    }

    public function __toString()
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return Foreman
     */
    public function getForeman()
    {
        return $this->foreman;
    }

    /**
     * @param Foreman $foreman
     */
    public function setForeman($foreman)
    {
        $this->foreman = $foreman;
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
}