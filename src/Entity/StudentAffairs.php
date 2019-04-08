<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentAffairsRepository")
 */
class StudentAffairs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Student", inversedBy="studentAffairs", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     */
    private $handbook;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     */
    private $aaua_cd;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     */
    private $mobile_platform;

    /**
     * @ORM\Column(type="datetime")
     */
    private $addedDate;

    /**
     * @var int
     * @ORM\Column(type="integer", length=1)
     */
    private $approve;

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

    public function getHandbook(): ?string
    {
        return $this->handbook;
    }

    public function setHandbook(string $handbook): self
    {
        $this->handbook = $handbook;

        return $this;
    }

    public function getAauaCd(): ?string
    {
        return $this->aaua_cd;
    }

    public function setAauaCd(string $aaua_cd): self
    {
        $this->aaua_cd = $aaua_cd;

        return $this;
    }

    public function getMobilePlatform(): ?string
    {
        return $this->mobile_platform;
    }

    public function setMobilePlatform(string $mobile_platform): self
    {
        $this->mobile_platform = $mobile_platform;

        return $this;
    }

    public function getAddedDate(): ?\DateTimeInterface
    {
        return $this->addedDate;
    }

    public function setAddedDate(\DateTimeInterface $addedDate): self
    {
        $this->addedDate = $addedDate;

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
