<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 21.07.18
 * Time: 18:13
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Admin
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class Admin extends User
{
    public function getRole()
    {
        return 'ROLE_ADMIN';
    }
}