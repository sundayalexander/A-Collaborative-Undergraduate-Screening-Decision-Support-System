<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminUnitRepository")
 * @UniqueEntity("phone_number", message="Phone number already exist.")
 * @UniqueEntity("email", message="Email address already exist.")
 */
class AdminUnit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $middle_name;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $last_name;

    /**
     * @ORM\Column(type="date")
     */
    private $dob;

    /**
     * @ORM\Column(type="string", length=200, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=13, unique=true)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $r_address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $p_address;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(0)
     * @Assert\LessThanOrEqual(100)
     */
    private $putme_score;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Exam", mappedBy="adminUnit")
     */
    private $exams;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Student", inversedBy="AdminUnit", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @var int
     * @ORM\Column(type="integer", length=1)
     */
    private $approve;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Jamb", cascade={"persist", "remove"})
     */
    private $jamb;

    public function __construct()
    {
        $this->exam = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    public function setMiddleName(string $middle_name): self
    {
        $this->middle_name = $middle_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getRAddress(): ?string
    {
        return $this->r_address;
    }

    public function setRAddress(string $r_address): self
    {
        $this->r_address = $r_address;

        return $this;
    }

    public function getPAddress(): ?string
    {
        return $this->p_address;
    }

    public function setPAddress(string $p_address): self
    {
        $this->p_address = $p_address;

        return $this;
    }

    public function getPutmeScore(): ?int
    {
        return $this->putme_score;
    }

    public function setPutmeScore(int $putme_score): self
    {
        $this->putme_score = $putme_score;

        return $this;
    }

    /**
     * @return Collection|Exam[]
     */
    public function getExams(): Collection
    {
        return $this->exams;
    }

    public function addExam(Exam $exam): self
    {
        if (!$this->exams->contains($exam)) {
            $this->exams[] = $exam;
            $exam->setAdminUnit($this);
        }

        return $this;
    }

    public function removeExam(Exam $exam): self
    {
        if ($this->exam->contains($exam)) {
            $this->exam->removeElement($exam);
            // set the owning side to null (unless already changed)
            if ($exam->getAdminUnit() === $this) {
                $exam->setAdminUnit(null);
            }
        }

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(Student $student): self
    {
        $this->student = $student;
        return $this;
    }

    public function getJamb(): ?Jamb
    {
        return $this->jamb;
    }

    public function setJamb(?Jamb $jamb): self
    {
        $this->jamb = $jamb;

        return $this;
    }

    /**
     * @return int
     */
    public function getApprove(): int
    {
        return $this->approve;
    }

    /**
     * @param int $approve
     */
    public function setApprove(int $approve): void
    {
        $this->approve = $approve;
    }
}
