<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 */
class BlogPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $blogId;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $url;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $pubDate;

    /**
     * @var Edition|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Edition", inversedBy="blogPosts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $edition;

    /**
     * BlogPost constructor.
     * @param $id
     * @param $title
     * @param $blogId
     * @param $url
     * @param $pubDate
     * @param Edition $edition
     */
    public function __construct($id, $title, $blogId, $url, $pubDate, Edition $edition = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->blogId = $blogId;
        $this->url = $url;
        $this->pubDate = $pubDate;
        $this->edition = $edition;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBlogId()
    {
        return $this->blogId;
    }

    /**
     * @param mixed $blogId
     */
    public function setBlogId($blogId): void
    {
        $this->blogId = $blogId;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPubDate(): \DateTimeImmutable
    {
        return $this->pubDate;
    }

    /**
     * @param mixed $pubDate
     */
    public function setPubDate(\DateTimeImmutable $pubDate): void
    {
        $this->pubDate = $pubDate;
    }

    /**
     * @return Edition
     */
    public function getEdition(): Edition
    {
        return $this->edition;
    }
}
