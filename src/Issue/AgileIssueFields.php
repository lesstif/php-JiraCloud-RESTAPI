<?php

namespace JiraCloud\Issue;

class AgileIssueFields extends IssueFieldV3
{
    /** @var \JiraCloud\Epic\Epic|null */
    public $epic;

    /** @var \JiraCloud\Sprint\Sprint|null */
    public $sprint;

    /** @var \JiraCloud\Sprint\Sprint[]|null */
    public $closedSprints;
}
