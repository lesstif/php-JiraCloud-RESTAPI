<?php

namespace JiraCloud\Issue;

class IssueType implements \JsonSerializable
{
    public string $self;

    public string $id;

    public ?string $description;

    public string $iconUrl;

    public string $name;

    public bool $subtask;

    public string $hierarchyLevel;

    /** @var \JiraCloud\Issue\IssueStatus[] */
    public $statuses;

    public int $avatarId;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
