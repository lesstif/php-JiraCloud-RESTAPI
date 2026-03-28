<?php

namespace JiraCloud\Project;

/**
 * Paginated Result object for BoardService.
 */
class PaginatedResult
{
    /**
     * @var int
     */
    public $startAt;

    /**
     * @var int
     */
    public $maxResults;

    /**
     * @var string
     */
    public $nextPage;

    /**
     * @var string
     */
    public $self;

    /**
     * @var int
     */
    public $total;

    /**
     * @var array
     */
    public $values;

    /**
     * @var bool
     */
    public $isLast;

    /**
     * @return int
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * @param int $startAt
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;
    }

    /**
     * @return int
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * @param int $maxResults
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
    }

    /**
     * @return string
     */
    public function getNextPage()
    {
        return $this->nextPage;
    }

    /**
     * @param string $nextPage
     */
    public function setNextPage($nextPage)
    {
        $this->nextPage = $nextPage;
    }

    /**
     * @return string
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * @param string $self
     */
    public function setSelf($self)
    {
        $this->self = $self;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

    /**
     * @param int $index
     *
     * @return mixed
     */
    public function getValue($index)
    {
        return $this->values[$index];
    }

    /**
     * @param bool $isLast
     */
    public function setIsLast($isLast)
    {
        $this->isLast = $isLast;
    }

    /**
     * @return bool
     */
    public function getIsLast()
    {
        return $this->isLast;
    }
}
