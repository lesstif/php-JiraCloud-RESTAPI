<?php

namespace JiraCloud\Issue;

use DateTimeInterface;

class Comment implements \JsonSerializable
{
    use VisibilityTrait;

    public string $self;

    public string $id;

    public Reporter $author;

    public string $body;

    public Reporter $updateAuthor;

    public ?DateTimeInterface $created;

    public ?DateTimeInterface $updated;

    public ?Visibility $visibility = null;

    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this));
    }
}
