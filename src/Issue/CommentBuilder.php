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
    private array $bodyParts = [];
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
        $this->body      = $body;
        $this->bodyParts = [];

        return $this;
    }

    /**
     * Adds a text part to the body.
     */
    public function addText(string $text): self
    {
        $this->bodyParts[] = $text;

        return $this;
    }

    /**
     * Adds a text part to the body.
     */
    public function addSentence(string $text): self
    {
        $this->bodyParts[] = "$text ";

        return $this;
    }

    /**
     * Adds a mention to a user by account ID.
     */
    public function addMention(string $accountId): self
    {
        $this->bodyParts[] = '[~accountid:' . $accountId . ']';

        return $this;
    }

    /**
     * Adds a line break to the body.
     */
    public function addLineBreak(): self
    {
        $this->bodyParts[] = PHP_EOL;

        return $this;
    }

    /**
     * Adds multiple line breaks to the body.
     */
    public function addLineBreaks(int $count = 2): self
    {
        $this->bodyParts[] = str_repeat(PHP_EOL, $count);

        return $this;
    }

    /**
     * Adds a link with text.
     */
    public function addLink(string $text, string $url): self
    {
        $this->bodyParts[] = '[' . $text . '|' . $url . ']';

        return $this;
    }

    /**
     * Adds formatted text (bold, italic, etc.).
     */
    public function addFormatted(string $text, string $format = 'bold'): self
    {
        $this->bodyParts[] = match ($format) {
            'bold' => '*' . $text . '*',
            'italic' => '_' . $text . '_',
            'code' => '{{' . $text . '}}',
            default => $text,
        };

        return $this;
    }

    public function bodyByAtlassianDocumentFormat(Document|Node $body): self
    {
        $this->body      = $body->jsonSerialize();
        $this->bodyParts = [];

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

    /**
     * Builds the body from all added parts if body parts exist.
     */
    private function buildBody(): string
    {
        if (empty($this->bodyParts)) {
            return $this->body;
        }

        return implode('', $this->bodyParts);
    }

    public function build(): Comment
    {
        $body = $this->buildBody();

        return new Comment(
            $this->self,
            $this->id,
            $this->author,
            $body,
            $this->updateAuthor,
            $this->created,
            $this->updated,
            $this->visibility,
            $this->jsdPublic,
            $this->renderedBody
        );
    }

    public static function new(): self
    {
        return new self();
    }
}
