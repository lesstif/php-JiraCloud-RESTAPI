<?php

namespace JiraCloud\IssueLink;

use JiraCloud\ClassSerialize;
use JiraCloud\Issue\Comment;
use JiraCloud\Issue\Issue;

class IssueLink implements \JsonSerializable
{
    use ClassSerialize;

    public array $type;

    public Issue $inwardIssue;

    public Issue $outwardIssue;

    public Comment $comment;

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        $vars = array_filter(get_object_vars($this));

        return $vars;
    }

    /**
     * @param string $typeName issue type string(ex:  'Duplicate')
     *
     * @return $this
     */
    public function setLinkTypeName($typeName)
    {
        $this->type['name'] = $typeName;

        return $this;
    }

    /**
     * @param string|int $issueKey inward issue key or id
     *
     * @return $this
     */
    public function setInwardIssue(string $issueKey): static
    {
        $this->inwardIssue = new Issue();
        $this->inwardIssue->key = $issueKey;

        return $this;
    }

    /**
     * @param string|int $issueKey out ward issue key or id
     *
     * @return $this
     */
    public function setOutwardIssue(string $issueKey): static
    {
        $this->outwardIssue = new Issue();
        $this->outwardIssue->key = $issueKey;

        return $this;
    }

    /**
     * @param string|Comment $comment string or \JiraCloud\Issue\Comment instance
     *
     * @return $this
     */
    public function setComment(string|Comment $comment): static
    {
        if (is_string($comment)) {
            $this->comment = new Comment();
            $this->comment->setBody($comment);
        } elseif ($comment instanceof Comment) {
            $this->comment = $comment;
        }

        return $this;
    }
}
