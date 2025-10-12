<?php

namespace JiraCloud\Issue;

use JiraCloud\DynamicPropertiesTrait;

/**
 * Issue search result.
 */
class IssueSearchResult
{
    use DynamicPropertiesTrait;

    /**
     * @var string|null
     */
    public $nextPageToken;

    /**
     * @var \JiraCloud\Issue\Issue[]
     */
    public $issues;

    /**
     * @return string|null
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
