<?php

namespace JiraCloud\Issue;

use DateTimeInterface;
use DH\Adf\Node\Block\Document;
use DH\Adf\Node\Node;

class Comment implements \JsonSerializable
{
    use VisibilityTrait;

    public string $self;

    public string $id;

    public Reporter $author;

    public string $body;

    public Reporter $updateAuthor;

    public ?DateTimeInterface $created;

    public ?DateTimeInterface $updated;

    public ?Visibility $visibility = null;

    public bool $jsdPublic;

    public string $renderedBody;

    /**
     * Comment constructor.
     */
    public function __construct(
        string             $self = '',
        string             $id = '',
        ?Reporter          $author = null,
        string             $body = '',
        ?Reporter          $updateAuthor = null,
        ?DateTimeInterface $created = null,
        ?DateTimeInterface $updated = null,
        ?Visibility        $visibility = null,
        bool               $jsdPublic = false,
        string             $renderedBody = ''
    )
    {
        $this->self         = $self;
        $this->id           = $id;
        $this->author       = $author ?? new Reporter();
        $this->body         = $body;
        $this->updateAuthor = $updateAuthor ?? new Reporter();
        $this->created      = $created;
        $this->updated      = $updated;
        $this->visibility   = $visibility;
        $this->jsdPublic    = $jsdPublic;
        $this->renderedBody = $renderedBody;
    }

    /**
     * mapping function for json_mapper.
     *
     * @param string $body
     *
     * @return $this
     */
    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function setBodyByAtlassianDocumentFormat(Document|Node $body): static
    {
        $this->body = $body->jsonSerialize();

        return $this;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this), function ($var) {
            return !is_null($var);
        });
    }

    public static function builder(): CommentBuilder
    {
        return new CommentBuilder();
    }
}
