<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Validator\Constraints as TaskAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     
 *     normalizationContext={"groups"={"read:task"}},
 *     denormalizationContext={"groups"={"write:task"}},
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "delete"}
 * )
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{

    public const PRIORITIES = [
        0 => 'Priorité Faible',
        1 => 'Priorité Moyenne',
        2 => 'Important',
        3 => 'Urgent'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:task"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:task", "write:task"})
     */
    private $title;

    /**
     * @ORM\Column(type="text",  nullable=true)
     * @Groups({"read:task", "write:task"})
     */
    private $comment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read:task", "write:task"})
     * @TaskAssert\IsTaskPriority()\
     */
    private $priority;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:task"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read:task"})
     */
    private $done;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:task"})
     */
    private $user;



    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->done = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }


    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function getPriorityType() : string
    {
        return self::PRIORITIES[$this->getPriority()];
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

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

    public function getDone(): ?bool
    {
        return $this->done;
    }

    public function setDone(bool $done): self
    {
        $this->done = $done;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
}
