<?php

namespace JiraCloud\Issue;

class SecurityScheme implements \JsonSerializable
{
    public string $self;

    public int $id;

    public string $name;

    public string $description;

    public int $defaultSecurityLevelId;

    public array $levels;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
