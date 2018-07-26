<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 20.07.18
 * Time: 11:58
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Good
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="goods")
 */
class Good
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Выберите тип товара")
     */
    protected $type;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Введите название")
     */
    protected $name;

    /**
     * @var integer|null
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(message="Добавьте вес товара")
     * @Assert\GreaterThan(0, message="Вес должен быть положительным")
     */
    protected $weight;

    /**
     * @var Loader
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Loader")
     */
    protected $loader;

    /**
     * Good constructor.
     */
    public function __construct()
    {
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
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int|null $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return Loader
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * @param Loader $loader
     */
    public function setLoader($loader)
    {
        $this->loader = $loader;
    }
}