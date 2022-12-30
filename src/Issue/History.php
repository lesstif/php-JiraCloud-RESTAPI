<?php

namespace JiraCloud\Issue;

/**
 * ChangeLog History.
 *
 * Class History
 */
class History implements \JsonSerializable
{
    public int $id;

    public Reporter $author;

    public string $created;

    public ?array $items;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
