<?php


namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class NestedSetCategory
 * @package App\Entity
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
class NestedSetCategory
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="NestedSetCategory")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="NestedSetCategory", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="NestedSetCategory", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function setRoot(NestedSetCategory $root = null)
    {
        $this->root = $root;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(NestedSetCategory $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * @param mixed $lft
     */
    public function setLft($lft): void
    {
        $this->lft = $lft;
    }

    /**
     * @return mixed
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * @param mixed $lvl
     */
    public function setLvl($lvl): void
    {
        $this->lvl = $lvl;
    }

    /**
     * @return mixed
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * @param mixed $rgt
     */
    public function setRgt($rgt): void
    {
        $this->rgt = $rgt;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}