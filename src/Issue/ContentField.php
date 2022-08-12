<?php

namespace JiraCloud\Issue;

class ContentField implements \JsonSerializable
{
    public string $type;
    public array $content;
    public array $attrs;

    public function __construct()
    {
        $this->content = [];
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
