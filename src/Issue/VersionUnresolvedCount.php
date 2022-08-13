<?php

namespace JiraCloud\Issue;

class VersionUnresolvedCount implements \JsonSerializable
{
    public string $self;

    public int $issuesUnresolvedCount;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    public function setSelf(string $self): static
    {
        $this->self = $self;

        return $this;
    }

    public function setIssuesUnresolvedCount(int $issuesUnresolvedCount): static
    {
        $this->issuesUnresolvedCount = $issuesUnresolvedCount;

        return $this;
    }
}
