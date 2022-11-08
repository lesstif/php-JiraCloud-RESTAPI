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

    public array $body;

    public Reporter $updateAuthor;

    public ?DateTimeInterface $created;

    public ?DateTimeInterface $updated;

    public ?Visibility $visibility = null;

    public bool $jsdPublic;

    /**
     * mapping function for json_mapper.
     *
     * @param \stdClass $body
     *
     * @return $this
     */
    public function setBody(\stdClass $body): static
    {
        $this->body = json_decode(json_encode($body), true);

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
}
