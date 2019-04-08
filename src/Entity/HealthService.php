<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HealthServiceRepository")
 */
class HealthService
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Student", inversedBy="health_service", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $lab_test;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $x_ray;

    /**
     * @var int
     * @ORM\Column(type="integer", length=1)
     */
    private $approve;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added_date;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLabTest(): ?string
    {
        return $this->lab_test;
    }

    public function setLabTest(string $lab_test): self
    {
        $this->lab_test = $lab_test;

        return $this;
    }

    public function getXRay(): ?string
    {
        return $this->x_ray;
    }

    public function setXRay(string $x_ray): self
    {
        $this->x_ray = $x_ray;

        return $this;
    }

    public function getAddedDate(): ?\DateTimeInterface
    {
        return $this->added_date;
    }

    public function setAddedDate(\DateTimeInterface $added_date): self
    {
        $this->added_date = $added_date;

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
