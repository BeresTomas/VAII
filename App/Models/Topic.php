<?php

// Vytvorene s pomocou AI (Claude).

namespace App\Models;

use Framework\Core\Model;

/**
 * Class Topic
 * One topic (thread) of the forum. The ORM maps it to the DB table `topics`.
 *
 * @package App\Models
 */
class Topic extends Model
{
    protected ?int $id = null;
    protected ?string $title;
    protected ?string $text;
    protected ?string $createdAt;
    protected ?string $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * Returns the number of posts (replies) in this topic.
     *
     * @return int
     * @throws \Exception
     */
    public function getPostCount(): int
    {
        return Post::getCount('`topic_id` = ?', [$this->id]);
    }
}
