<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 * @UniqueEntity("username",message="This username has already been registered.")
 */
class Admin implements \Serializable {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100,unique=true)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(min=8)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Choice(choices={
     *     "AdminUnit","HealthService",
     *     "ExamsAndRecords","Faculty",
     *     "StudentAffairs"},message="Please select a valid unit")
     */
    private $unit;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registered_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getHashedPassword(): ?string{
        return password_hash($this->password,PASSWORD_BCRYPT);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function isPasswordValid(string $password){
        return password_verify($password,$this->password);
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getRegisteredDate(): ?\DateTimeInterface
    {
        return $this->registered_date;
    }

    public function setRegisteredDate(\DateTimeInterface $registered_date): self
    {
        $this->registered_date = $registered_date;

        return $this;
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([$this->id,$this->username,$this->unit]);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list($this->id,$this->username,$this->unit) = unserialize($serialized);
    }
}
