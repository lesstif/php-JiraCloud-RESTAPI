<?php

namespace JiraCloud\Label;

use JiraCloud\ClassSerialize;
use JiraCloud\DynamicPropertiesTrait;

class LabelSearchResult implements \JsonSerializable
{
    use ClassSerialize;
    use DynamicPropertiesTrait;

    /**
     * @var int
     */
    public $maxResults;

    /**
     * @var int
     */
    public $startAt;

    /**
     * @var int
     */
    public $total;

    /**
     * @var bool
     */
    public $isLast = false;

    /**
     * @var array
     */
    public $values;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    public function getMaxResults(): int
    {
        return $this->maxResults;
    }

    public function setMaxResults(int $maxResults): void
    {
        $this->maxResults = $maxResults;
    }

    public function getStartAt(): int
    {
        return $this->startAt;
    }

    public function setStartAt(int $startAt): void
    {
        $this->startAt = $startAt;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    public function isLast(): bool
    {
        return $this->isLast;
    }

    public function setIsLast(bool $isLast): void
    {
        $this->isLast = $isLast;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function setValues(array $values): void
    {
        $this->values = $values;
    }
}
