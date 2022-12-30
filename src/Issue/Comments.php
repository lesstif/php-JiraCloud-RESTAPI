<?php

namespace JiraCloud\Issue;

class Comments implements \JsonSerializable
{
    public string $self;
    
    public int $startAt;

    public int $maxResults;

    public int $total;

    /** @var \JiraCloud\Issue\Comment[] */
    public $comments;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
