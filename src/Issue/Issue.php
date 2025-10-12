<?php

namespace JiraCloud\Issue;

use JiraCloud\DynamicPropertiesTrait;

class Issue implements \JsonSerializable
{
    use DynamicPropertiesTrait;

    /**
     * return only if Project query by key(not id).
     */
    public ?string $expand;

    public string $self;

    public string $id;

    public string $key;

    public IssueField $fields;

    public ?array $renderedFields;

    public ?array $names;

    public ?array $schema;

    public ?array $transitions;

    public ?array $operations;

    public ?array $editmeta;

    public ?ChangeLog $changelog;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
