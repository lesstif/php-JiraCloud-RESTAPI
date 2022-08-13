<?php

namespace JiraCloud\Request;

use DateTimeInterface;

class RequestComment implements \JsonSerializable
{
    public string $id;

    public string $body;

    public bool $public;

    public Author $author;

    public ?DateTimeInterface $created;

    public function setBody(string $body) : static
    {
        $this->body = $body;

        return $this;
    }

    public function setIsPublic(bool $public) : static
    {
        $this->public = $public;

        return $this;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() : array
    {
        return array_filter(get_object_vars($this), function ($var) {
            return $var !== null;
        });
    }
}
