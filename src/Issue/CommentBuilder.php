<?php

namespace JiraCloud\Issue;

use DateTimeInterface;
use DH\Adf\Node\Block\Document;
use DH\Adf\Node\Node;

/**
 * Builder class for Comment.
 */
class CommentBuilder
{
    private string $self = '';
    private string $id = '';
    private ?Reporter $author = null;
    private string $body = '';
    private ?Reporter $updateAuthor = null;
    private ?DateTimeInterface $created = null;
    private ?DateTimeInterface $updated = null;
    private ?Visibility $visibility = null;
    private bool $jsdPublic = false;
    private string $renderedBody = '';

    public function self(string $self): self
    {
        $this->self = $self;

        return $this;
    }

    public function id(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function author(Reporter $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function body(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function bodyByAtlassianDocumentFormat(Document|Node $body): self
    {
        $this->body = $body->jsonSerialize();

        return $this;
    }

    public function updateAuthor(Reporter $updateAuthor): self
    {
        $this->updateAuthor = $updateAuthor;

        return $this;
    }

    public function created(?DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function updated(?DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function visibility(?Visibility $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function jsdPublic(bool $jsdPublic): self
    {
        $this->jsdPublic = $jsdPublic;

        return $this;
    }

    public function renderedBody(string $renderedBody): self
    {
        $this->renderedBody = $renderedBody;

        return $this;
    }

    public function build(): Comment
    {
        return new Comment(
            $this->self,
            $this->id,
            $this->author,
            $this->body,
            $this->updateAuthor,
            $this->created,
            $this->updated,
            $this->visibility,
            $this->jsdPublic,
            $this->renderedBody
        );
    }
}
