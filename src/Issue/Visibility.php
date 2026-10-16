<?php

namespace JiraCloud\Issue;

class Visibility implements \JsonSerializable
{
    private string $type;
    private string $value;
    private ?string $identifier = null;

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function setIdentifier(?string $identifier)
    {
        $this->identifier = $identifier;
    }    

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }
    
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
