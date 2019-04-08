<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JambRepository")
 */
class Jamb
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $jamb_number;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $subject_1;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $subject_2;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $subject_3;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $subject_4;

    /**
     * @ORM\Column(type="integer", length=40)
     */
    private $score_1;

    /**
     * @ORM\Column(type="integer", length=40)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $score_2;

    /**
     * @ORM\Column(type="integer", length=40)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $score_3;

    /**
     * @ORM\Column(type="integer", length=40)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $score_4;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJambNumber(): ?string
    {
        return $this->jamb_number;
    }

    public function setJambNumber(string $jamb_number): self
    {
        $this->jamb_number = $jamb_number;

        return $this;
    }

    public function getSubject1(): ?string
    {
        return $this->subject_1;
    }

    public function setSubject1(string $subject_1): self
    {
        $this->subject_1 = $subject_1;

        return $this;
    }

    public function getSubject2(): ?string
    {
        return $this->subject_2;
    }

    public function setSubject2(string $subject_2): self
    {
        $this->subject_2 = $subject_2;

        return $this;
    }

    public function getSubject3(): ?string
    {
        return $this->subject_3;
    }

    public function setSubject3(string $subject_3): self
    {
        $this->subject_3 = $subject_3;

        return $this;
    }

    public function getSubject4(): ?string
    {
        return $this->subject_4;
    }

    public function setSubject4(string $subject_4): self
    {
        $this->subject_4 = $subject_4;

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
     * @return mixed
     */
    public function getScore1():? int
    {
        return $this->score_1;
    }

    /**
     * @param mixed $score_1
     */
    public function setScore1(int $score_1): void
    {
        $this->score_1 = $score_1;
    }

    /**
     * @return mixed
     */
    public function getScore2(): ? int
    {
        return $this->score_2;
    }

    /**
     * @param mixed $score_2
     */
    public function setScore2(int $score_2): void
    {
        $this->score_2 = $score_2;
    }

    /**
     * @return mixed
     */
    public function getScore3():? int
    {
        return $this->score_3;
    }

    /**
     * @param mixed $score_3
     */
    public function setScore3(int $score_3): void
    {
        $this->score_3 = $score_3;
    }

    /**
     * @return mixed
     */
    public function getScore4():? int
    {
        return $this->score_4;
    }

    /**
     * @param mixed $score_4
     */
    public function setScore4(int $score_4): void
    {
        $this->score_4 = $score_4;
    }

}
