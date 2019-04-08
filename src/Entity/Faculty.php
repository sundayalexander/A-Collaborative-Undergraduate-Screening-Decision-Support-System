<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FacultyRepository")
 */
class Faculty
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     */
    private $prospectus;

    /**
     * @var int
     * @ORM\Column(type="integer", length=1)
     */
    private $approve;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Student", inversedBy="faculty", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     */
    private $matric_gown;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     */
    private $due;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProspectus(): ?string
    {
        return $this->prospectus;
    }

    public function setProspectus(string $prospectus): self
    {
        $this->prospectus = $prospectus;
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

    public function getMatricGown(): ?string
    {
        return $this->matric_gown;
    }

    public function setMatricGown(string $matric_gown): self
    {
        $this->matric_gown = $matric_gown;
        return $this;
    }

    public function getDue(): ?string
    {
        return $this->due;
    }

    public function setDue(string $due): self
    {
        $this->due = $due;
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
