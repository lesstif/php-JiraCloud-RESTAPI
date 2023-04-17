<?php

namespace JiraCloud\IssueLink;

class LinkedIssue implements \JsonSerializable
{
    public string $self;

    public string $id;
    public string $key;

    public array $fields;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
