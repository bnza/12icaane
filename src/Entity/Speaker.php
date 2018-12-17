<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpeakerRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Speaker
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $main_author;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $other_authors;

    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $affiliation;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $theme;

    /**
     * @Assert\Length(
     *      min = 400,
     *      max = 1000,
     *      minMessage = "Abstract must be at least {{ limit }} characters long",
     *      maxMessage = "Abstract cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $abstract;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payment_id;

    /**
     * @Assert\Length(
     *      max = 300,
     *      maxMessage = "Remarks cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarks;

    /**
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMainAuthor(): ?string
    {
        return $this->main_author;
    }

    public function setMainAuthor(string $main_author): self
    {
        $this->main_author = $main_author;

        return $this;
    }

    public function getOtherAuthors(): ?string
    {
        return $this->other_authors;
    }

    public function setOtherAuthors(?string $other_authors): self
    {
        $this->other_authors = $other_authors;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function setAffiliation(string $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $Abstract): self
    {
        $this->abstract = $Abstract;

        return $this;
    }

    public function getPaymentId(): ?string
    {
        return $this->payment_id;
    }

    public function setPaymentId(string $payment_id): self
    {
        $this->payment_id = $payment_id;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime();
    }
}
