<?php

namespace JiraCloud\ADF;

/**
 * Class AtlassianDocumentFormat.
 */
class AtlassianDocumentFormat implements \JsonSerializable
{
    public string $self;

    public string $type = 'doc';

    public int $version = 1;

    public array $content;

    public ?array $paragraph = [];
    public ?array $heading = [];
    public ?array $bulletList = [];

    private ?array $elements = ['heading', 'paragraph', 'bulletList', ];

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        foreach ($this->elements as $element) {
            if (count($this->{$element}) === 0) {
                continue;
            }

            $this->content[] = $this->{$element};
        }

        foreach ($this->elements as $element) {
            $this->{$element} = null;
        }

        $this->elements = null;

        return array_filter(get_object_vars($this), function ($var) {
            return !is_null($var);
        });
    }

    public function appendParagraphContent(string $text, ADFMarkType $markType = null) : void
    {
        if (empty($this->paragraph['type'])) {
            $this->paragraph['type'] = 'paragraph';
        }

        $c = [
            'type' => 'text',
            'text' => $text,
        ];

        if ($markType != null) {
            $c['marks'][] = ['type' => $markType->name()];
        }

        $this->paragraph['content'][] = $c;
    }

    public function appendParagraphLink(string $text, string $url) : void
    {
        if (empty($this->paragraph['type'])) {
            $this->paragraph['type'] = 'paragraph';
        }

        $c = [
            'type' => 'text',
            'text' => $text,
        ];

        $c['marks'][] = [
            'type' => 'link',
            'attrs' => [ 'href' => $url ],
        ];

        $this->paragraph['content'][] = $c;
    }

    public function createParagraphContent(string $text, ADFMarkType $markType = null) : void
    {
        if (! empty($this->paragraph['content'])) {
            $this->content[] = $this->paragraph;
            $this->paragraph = null;
        }

        $this->appendParagraphContent($text, $markType);
    }

    public function createHeadingContent(string $text, int $level, ADFMarkType $markType = null)
    {
        if ($level < 1 || $level > 7) {
            throw new \LogicException("the level must between 1 to 7.");
        }

        $heading = [];

        $heading['type'] = 'heading';
        $heading['attrs'] = [ 'level' => $level, ];
        $heading['content'][] = [
            'type' => 'text',
            'text' => $text,
        ];

        $this->content[] = $heading;
    }

    public function createListItem(string $text, ADFListItemTypes $listItemTypes)
    {
        if (! empty($this->bulletList['content'])) {
            $this->content[] = $this->bulletList;
            $this->bulletList = null;
        }

        $this->appendListItem($text, $listItemTypes);
    }

    public function appendListItem(string $text, ADFListItemTypes $listItemTypes) : void
    {
        if (empty($this->bulletList['type'])) {
            $this->bulletList['type'] = $listItemTypes->name();
        }

        $c = [
            'type' => 'listItem',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [[
                        'type' => 'text',
                        'text' => $text,
                    ]],
                ]
            ],
        ];

        $this->bulletList['content'][] = $c;
    }
}
