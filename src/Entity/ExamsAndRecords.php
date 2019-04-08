<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamsAndRecordsRepository")
 */
class ExamsAndRecords
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Student", inversedBy="examsAndRecords", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $jambLetter;

    /**
     * @var int
     * @ORM\Column(type="integer", length=1)
     */
    private $approve;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $aauaLetter;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $birthCertificate;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $stateOfOrigin;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $attestationLetter;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $jambResult;

    /**
     * @ORM\Column(type="datetime")
     */
    private $addedDate;

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

    public function getJambLetter(): ?string
    {
        return $this->jambLetter;
    }

    public function setJambLetter(string $jambLetter): self
    {
        $this->jambLetter = $jambLetter;

        return $this;
    }

    public function getAauaLetter(): ?string
    {
        return $this->aauaLetter;
    }

    public function setAauaLetter(string $aauaLetter): self
    {
        $this->aauaLetter = $aauaLetter;

        return $this;
    }

    public function getBirthCertificate(): ?string
    {
        return $this->birthCertificate;
    }

    public function setBirthCertificate(string $birthCertificate): self
    {
        $this->birthCertificate = $birthCertificate;

        return $this;
    }

    public function getStateOfOrigin(): ?string
    {
        return $this->stateOfOrigin;
    }

    public function setStateOfOrigin(string $stateOfOrigin): self
    {
        $this->stateOfOrigin = $stateOfOrigin;
        return $this;
    }

    public function getAttestationLetter(): ?string
    {
        return $this->attestationLetter;
    }

    public function setAttestationLetter(string $attestationLetter): self
    {
        $this->attestationLetter = $attestationLetter;

        return $this;
    }

    public function getJambResult(): ?string
    {
        return $this->jambResult;
    }

    public function setJambResult(string $jambResult): self
    {
        $this->jambResult = $jambResult;

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
