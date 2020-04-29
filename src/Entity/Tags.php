<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tags
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity
 */
/**
 * @ORM\Entity(repositoryClass="App\Repository\TagsRepository")
 */
class Tags
{
    /**
     * @var int
     *
     * @ORM\Column(name="tag_name", type="integer",  nullable=false)
     * @ORM\Id
     * @Groups("image:read")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tagName;
        /**
     * @var string
     *
     * @ORM\Column(name="tag_title", type="string", length=255, nullable=false)
     * @Groups("image:read")
     */
    private $tagTitle;

    public function getTagName(): ?int
    {
        return $this->tagName;
    }
    
    public function setTagName(?string $tagName): self
    {
        $this->tagName = $tagName;

        return $this;
    }
    public function getTagTitle(): ?string
    {
        return $this->tagTitle;
    }

    public function setTagTitle(?string $tagTitle): self
    {
        $this->tagTitle = $tagTitle;

        return $this;
    }


}
