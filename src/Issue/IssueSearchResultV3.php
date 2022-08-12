<?php

namespace JiraCloud\Issue;

/**
 * Issue search result.
 */
class IssueSearchResultV3 extends IssueSearchResult
{
    /**
     * @var \JiraCloud\Issue\IssueV3[]
     */
    public $issues;

    /**
     * @return \JiraCloud\Issue\IssueV3[]
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * @param \JiraCloud\Issue\IssueV3[] $issues
     */
    public function setIssues($issues)
    {
        $this->issues = $issues;
    }
}
