<?php

namespace JiraCloud\Issue;

class Comments implements \JsonSerializable
{
    /** @var int */
    public $startAt;

    /** @var int */
    public $maxResults;

    /** @var int */
    public $total;

    /** @var \JiraCloud\Issue\Comment[] */
    public $comments;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
