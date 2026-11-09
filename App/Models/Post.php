<?php

namespace App\Models;

use Framework\Core\Model;

/**
 * Class Post
 * One reply in a forum topic. The ORM maps it to the DB table `posts`.
 * Every post belongs to one topic (column `topic_id`), one topic has many posts.
 *
 * @package App\Models
 */
class Post extends Model
{
    protected ?int $id = null;
    protected ?string $text;
    protected ?string $createdAt;
    protected ?string $author;
    protected ?int $topic_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTopicId(): ?int
    {
        return $this->topic_id;
    }

    public function setTopicId(int $topicId): void
    {
        $this->topic_id = $topicId;
    }
}
