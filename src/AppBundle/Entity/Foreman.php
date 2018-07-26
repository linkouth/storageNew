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
use Symfony\Component\Security\Core\User\UserInterface;

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
}