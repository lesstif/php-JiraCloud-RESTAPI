<?php

namespace JiraCloud\Issue;

use JiraCloud\JsonSerializableTrait;

class AgileIssue extends Issue
{
    use JsonSerializableTrait;

    /** @var \JiraCloud\Issue\AgileIssueFields */
    public IssueField $fields;
}
