<?php

namespace JiraCloud\Issue;

class AgileIssueFields extends IssueField
{
    /** @var \JiraCloud\Epic\Epic|null */
    public $epic;

    /** @var \JiraCloud\Sprint\Sprint|null */
    public $sprint;

    /** @var \JiraCloud\Sprint\Sprint[]|null */
    public $closedSprints;
}
