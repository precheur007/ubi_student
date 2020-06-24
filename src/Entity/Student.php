<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *   itemOperations={
 *      "get"={"method"="GET"},
 *      "put"={"method"="PUT"},
 *      "delete"={"method"="DELETE"},
 *      "studentAvgGrades"={
 *        "route_name"="student_avggrades",
 *        "swagger_context" = {
 *          "parameters" = {
 *            {
 *              "name" = "id",
 *              "in" = "path",
 *              "required" = "true",
 *              "type" = "string"
 *            }
 *          },
 *          "responses" = {
 *            "200" = {
 *              "description" = "The student average grades has been returned in the response"
 *            }
 *          }
 *        }
 *      }
 *   }
 * )
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
	 * @ApiProperty(identifier=true)
	 * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $birthday;

	/**
    * @ORM\OneToMany(targetEntity=Grade::class, cascade={"persist", "remove"}, mappedBy="student")
    */
    private $grades;

    public function __construct()
    {
        $this->grades = new ArrayCollection();
    }
	
	public function __toString()
	{
		return (string) $this->getId();
	}
	
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthday(): ?\DatetimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DatetimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }
	
    /**
     * @return Collection|Grade[]
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setStudent($this);
        }

        return $this;
    }

    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->contains($grade)) {
            $this->grades->removeElement($grade);
            // set the owning side to null (unless already changed)
            if ($grade->getStudent() === $this) {
                $grade->setStudent(null);
            }
        }

        return $this;
    }
}
