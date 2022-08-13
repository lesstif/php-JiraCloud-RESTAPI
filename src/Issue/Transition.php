<?php

namespace JiraCloud\Issue;

/**
 * Issue Transition mapping class.
 */
class Transition implements \JsonSerializable
{
    public string $id;

    public string $name;

    public TransitionTo $to;

    public array $fields;

    public IssueField $issueFields;

    public ?array $transition;

    public ?array $update;

    public function setTransitionName($name): void
    {
        if (is_null($this->transition)) {
            $this->transition = [];
        }

        $this->transition['name'] = $name;
    }

    /**
     * set none translated transition name.
     */
    public function setUntranslatedName(string $untranslatedName): void
    {
        if (is_null($this->transition)) {
            $this->transition = [];
        }

        $this->transition['untranslatedName'] = $untranslatedName;
    }

    public function setTransitionId(string $id): void
    {
        if (is_null($this->transition)) {
            $this->transition = [];
        }

        $this->transition['id'] = $id;
    }

    public function setCommentBody(string $commentBody): void
    {
        if (is_null($this->update)) {
            $this->update = [];
            $this->update['comment'] = [];
        }

        $ar = [];
        $ar['add']['body'] = $commentBody;
        array_push($this->update['comment'], $ar);
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
