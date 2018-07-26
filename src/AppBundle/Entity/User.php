<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 25.07.18
 * Time: 14:41
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="users")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="integer", fieldName="type")
 * @ORM\DiscriminatorMap({
 *     1 = "Foreman",
 *     2 = "Admin",
 * })
 */
abstract class User implements UserInterface
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Loader", mappedBy="foreman")
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
     * @var string
     * @ORM\Column(type="string", unique=true)
     *
     * @Assert\NotBlank(message="Введите Ваш Email")
     * @Assert\Email(message="Некорректный Email")
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Придумайте пароль")
     * @Assert\Length(
     *     min=8,
     *     max=20,
     *     minMessage="Ваш пароль должен быть как минимум {{ limit }} символов",
     *     maxMessage="Ваш пароль не должен быть длиннее {{ limit }} символов"
     * )
     */
    protected $password;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $role;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $salt;

    public function __construct() {}

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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}