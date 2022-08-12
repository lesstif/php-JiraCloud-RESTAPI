<?php

namespace JiraCloud\Issue;

class Comment implements \JsonSerializable
{
    use VisibilityTrait;

    /** @var string */
    public $self;

    /** @var string */
    public $id;

    /** @var \JiraCloud\Issue\Reporter */
    public $author;

    /** @var string */
    public $body;

    /** @var \JiraCloud\Issue\Reporter */
    public $updateAuthor;

    /** @var \DateTimeInterface */
    public $created;

    /** @var \DateTimeInterface */
    public $updated;

    /** @var \JiraCloud\Issue\Visibility */
    public $visibility;

    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
