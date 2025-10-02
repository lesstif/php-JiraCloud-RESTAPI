<?php

namespace JiraCloud\Issue;

/**
 * Issue search result.
 */
class IssueSearchResult
{
    /**
     * @var bool
     */
    public $isLast = false;

    /**
     * @var string
     */
    public $nextPageToken;

    /**
     * @var \JiraCloud\Issue\Issue[]
     */
    public $issues;

    /**
     * @return bool
     */
    public function getIsLast()
    {
        return $this->isLast;
    }

    /**
     * @param bool $isLast
     */
    public function setIsLast($isLast)
    {
        return $this->isLast;
    }

    /**
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->nextPageToken;
    }

    /**
     * @param string $nextPageToken
     */
    public function setNextPageToken($nextPageToken)
    {
        $this->nextPageToken = $nextPageToken;
    }

    /**
     * @return Issue[]
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * @param Issue[] $issues
     */
    public function setIssues($issues)
    {
        $this->issues = $issues;
    }

    /**
     * @param int $ndx
     *
     * @return Issue
     */
    public function getIssue($ndx)
    {
        return $this->issues[$ndx];
    }
}
