<?php

namespace JiraCloud\IssueLink;

use JiraCloud\ADF\AtlassianDocumentFormat;
use JiraCloud\ClassSerialize;

class IssueLink implements \JsonSerializable
{
    use ClassSerialize;

    public string $id;
    public string $self;

    public array $type;

    public ?LinkedIssue $inwardIssue = null;

    public ?LinkedIssue $outwardIssue = null;

    public array $comment = [];

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
     * @param string $issueKey inward issue key or id
     *
     * @return $this
     */
    public function setInwardIssueByKey(string $issueKey): static
    {
        if ($this->inwardIssue === null) {
            $this->inwardIssue = new LinkedIssue();
        }
        $this->inwardIssue->key = $issueKey;

        return $this;
    }

    /**
     * @param string $issueKey out ward issue key or id
     *
     * @return $this
     */
    public function setOutwardIssueByKey(string $issueKey): static
    {
        if ($this->outwardIssue === null) {
            $this->outwardIssue = new LinkedIssue();
        }

        $this->outwardIssue->key = $issueKey;

        return $this;
    }

    /**
     * @param AtlassianDocumentFormat $comment string or \JiraCloud\Issue\Comment instance
     *
     * @return $this
     */
    public function setCommentAsADF(?AtlassianDocumentFormat $comment): static
    {
        if (!empty($comment)) {
            $this->comment['body'] = $comment;
        }

        return $this;
    }
}
