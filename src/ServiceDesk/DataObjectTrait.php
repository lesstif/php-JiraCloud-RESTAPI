<?php

namespace JiraCloud\ServiceDesk;

trait DataObjectTrait
{
    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this));
    }
}
