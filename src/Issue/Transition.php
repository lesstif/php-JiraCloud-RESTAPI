<?php

namespace JiraCloud\Issue;

use JiraCloud\ADF\AtlassianDocumentFormat;

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

    public ?array $transition = null;

    public ?array $update = null;

    public bool $hasScreen;
    public bool $isGlobal;
    public bool $isInitial;
    public bool $isAvailable;
    public bool $isConditional;
    public bool $isLooped;

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

    public function setCommentBody(AtlassianDocumentFormat $commentBody): void
    {
        if (is_null($this->update)) {
            $this->update = [];
            $this->update['comment'] = [];
        }

        $ar = [];
        $ar['add']['body'] = $commentBody->jsonSerialize();

        array_push($this->update['comment'], $ar);
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
