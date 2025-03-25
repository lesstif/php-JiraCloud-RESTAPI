<?php

namespace JiraCloud\Board;

class BoardColumnConfig implements \JsonSerializable
{
    use \JiraCloud\JsonSerializableTrait;


    /** @var BoardColumn[] $columns */
    public array $columns;
    public string $constraintType;
}
