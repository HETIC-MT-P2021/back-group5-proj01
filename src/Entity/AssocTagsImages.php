<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AssocTagsImages
 *
 * @ORM\Table(name="assoc_tags_images", indexes={@ORM\Index(name="fk_image", columns={"image_id"}), @ORM\Index(name="fk_tag", columns={"tag_name"})})
 * @ORM\Entity
 */
class AssocTagsImages
{
    /**
     * @var int
     *
     * @ORM\Column(name="assoc_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $assocId;

    /**
     * @var int
     *
     * @ORM\Column(name="image_id", type="integer", nullable=false)
     */
    private $imageId;

    /**
     * @var int
     *
     * @ORM\Column(name="tag_name", type="integer", nullable=false)
     */
    private $tagName;

    public function getAssocId(): ?int
    {
        return $this->assocId;
    }

    public function getImageId(): ?int
    {
        return $this->imageId;
    }

    public function setImageId(int $imageId): self
    {
        $this->imageId = $imageId;

        return $this;
    }

    public function getTagName(): ?int
    {
        return $this->tagName;
    }

    public function setTagName(int $tagName): self
    {
        $this->tagName = $tagName;

        return $this;
    }


}
