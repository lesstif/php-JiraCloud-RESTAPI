<?php

namespace JiraCloud\Board;

class BoardColumnConfig implements \JsonSerializable
{
    use \JiraCloud\JsonSerializableTrait;

    /** @var BoardColumn[] */
    public array $columns;
    public string $constraintType;
}
