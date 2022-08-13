<?php

namespace JiraCloud\Request;

class Author implements \JsonSerializable
{
    public string $name;

    public string $key;

    public string $emailAddress;

    public string $displayName;

    public bool $active;

    public string $timeZone;

    #[\ReturnTypeWillChange]
    public function jsonSerialize() : array
    {
        return array_filter(get_object_vars($this));
    }
}
