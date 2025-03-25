<?php

namespace JiraCloud\Board;

class BoardColumn implements \JsonSerializable
{
    use \JiraCloud\JsonSerializableTrait;

    public string $name;
    public ?int $max = null;
    public ?int $min = null;
    public array $statuses = [];
}
