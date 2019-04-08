<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * @UniqueEntity("matric_number", message="This matric number already exist!")
 */
class Student implements \Serializable{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",unique=true)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(min=9)
     */
    private $matric_number;

    /**
     * @var string
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(min=8)
     */
    private $confirmPassword;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registered_date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AdminUnit", mappedBy="student", cascade={"persist", "remove"})
     */
    private $AdminUnit;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\HealthService", mappedBy="student", cascade={"persist", "remove"})
     */
    private $health_service;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Faculty", mappedBy="student", cascade={"persist", "remove"})
     */
    private $faculty;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StudentAffairs", mappedBy="student", cascade={"persist", "remove"})
     */
    private $studentAffairs;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ExamsAndRecords", mappedBy="student", cascade={"persist", "remove"})
     */
    private $examsAndRecords;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHashedPassword():? string {
        return password_hash($this->password,PASSWORD_BCRYPT);
    }

    public function getMatricNumber(): ?string
    {
        return $this->matric_number;
    }

    public function setMatricNumber(string $matric_number): self
    {
        $this->matric_number = $matric_number;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getAdminUnit(): ?AdminUnit
    {
        return $this->AdminUnit;
    }

    public function setAdminUnit(AdminUnit $AdminUnit): self
    {
        $this->AdminUnit = $AdminUnit;

        // set the owning side of the relation if necessary
        if ($this !== $AdminUnit->getStudent()) {
            $AdminUnit->setStudent($this);
        }

        return $this;
    }

    public function getHealthService(): ?HealthService
    {
        return $this->health_service;
    }

    public function setHealthService(HealthService $health_service): self
    {
        $this->health_service = $health_service;

        // set the owning side of the relation if necessary
        if ($this !== $health_service->getStudent()) {
            $health_service->setStudent($this);
        }

        return $this;
    }

    public function getFaculty(): ?Faculty
    {
        return $this->faculty;
    }

    public function setFaculty(Faculty $faculty): self
    {
        $this->faculty = $faculty;

        // set the owning side of the relation if necessary
        if ($this !== $faculty->getStudent()) {
            $faculty->setStudent($this);
        }

        return $this;
    }

    public function getStudentAffairs(): ?StudentAffairs
    {
        return $this->studentAffairs;
    }

    public function setStudentAffairs(StudentAffairs $studentAffairs): self
    {
        $this->studentAffairs = $studentAffairs;

        // set the owning side of the relation if necessary
        if ($this !== $studentAffairs->getStudent()) {
            $studentAffairs->setStudent($this);
        }

        return $this;
    }

    public function getExamsAndRecords(): ?ExamsAndRecords
    {
        return $this->examsAndRecords;
    }

    public function setExamsAndRecords(ExamsAndRecords $examsAndRecords): self
    {
        $this->examsAndRecords = $examsAndRecords;

        // set the owning side of the relation if necessary
        if ($this !== $examsAndRecords->getStudent()) {
            $examsAndRecords->setStudent($this);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmPassword():? string
    {
        return $this->confirmPassword;
    }

    /**
     * @param string $confirmPassword
     */
    public function setConfirmPassword(string $confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([$this->id,$this->matric_number]);
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
        list($this->id,$this->matric_number) = unserialize($serialized);
    }
}
