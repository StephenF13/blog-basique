<?php

namespace BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 *
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $fullName;
    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\Email()
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @ORM\Column(type="json_array")
     */
    private $roles;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setFullName(string $fullName)
    {
        $this->fullName = $fullName;
    }
    public function getFullName(): string
    {
        return $this->fullName;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    /**
     * Returns the roles or permissions granted to the user for security.
     */
    public function getRoles()
    {
        return $this->roles;
    }
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getSalt()
    {

    }

    public function eraseCredentials()
    {
        
    }

}