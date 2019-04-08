<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamRepository")
 */
class Exam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Choice(choices={"WAEC","NECO"},
     *     message="Please select a valid exam type")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(mimeTypes={"image/jpg","image/png","image/jpeg"})
     */
    private $result;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AdminUnit", inversedBy="exam")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adminUnit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): self
    {
        $this->result = $result;

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

    public function getAdminUnit(): ?AdminUnit
    {
        return $this->adminUnit;
    }

    public function setAdminUnit(?AdminUnit $adminUnit): self
    {
        $this->adminUnit = $adminUnit;
        return $this;
    }
}
