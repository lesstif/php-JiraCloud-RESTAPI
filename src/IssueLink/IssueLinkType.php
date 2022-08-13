<?php

namespace JiraCloud\IssueLink;

use JiraCloud\ClassSerialize;

/**
 * Class IssueLinkType.
 *
 * @see https://docs.atlassian.com/jira/REST/server/#api/2/issueLinkType-createIssueLinkType
 */
class IssueLinkType implements \JsonSerializable
{
    use ClassSerialize;

    public int $id;

    public string $name;

    public string $inward;

    public string $outward;

    public string $self;

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        $vars = array_filter(get_object_vars($this));

        return $vars;
    }
}
