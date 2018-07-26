<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 20.07.18
 * Time: 12:26
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Loader
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="loaders")
 */
class Loader
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Good", mappedBy="loader")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Введите имя")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Введите фамилию")
     */
    protected $surname;

    /**
     * @var ArrayCollection|Good[]
     */
    protected $goods;

    /**
     * @var Foreman
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Foreman")
     */
    protected $foreman;

    /**
     * Loader constructor.
     */
    public function __construct()
    {
        $this->goods = new ArrayCollection();
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return Good[]|ArrayCollection
     */
    public function getGoods()
    {
        return $this->goods;
    }

    /**
     * @param Good[]|ArrayCollection $goods
     */
    public function setGoods($goods)
    {
        $this->goods = $goods;
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
}