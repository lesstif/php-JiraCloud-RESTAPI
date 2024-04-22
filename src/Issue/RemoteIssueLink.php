<?php

namespace JiraCloud\Issue;

class RemoteIssueLink implements \JsonSerializable
{
    public int $id;

    public string $self;

    public ?string $globalId = null;

    public ?array $application;

    public ?string $relationship;

    public ?RemoteObject $object;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    public function __construct()
    {
        $this->object = new RemoteObject();
    }

    public function setUrl(string $url): static
    {
        $this->globalId = $url;
        $this->object->url = $url;

        return $this;
    }

    public function setTitle($title): static
    {
        $this->object->title = $title;

        return $this;
    }

    public function setSummary($summary): static
    {
        $this->object->summary = $summary;

        return $this;
    }

    public function setRelationship($relationship): static
    {
        $this->relationship = $relationship;

        return $this;
    }
}
