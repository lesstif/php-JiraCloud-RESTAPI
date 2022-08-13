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

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $this->content[] = $this->paragraph;

        $this->paragraph = null;

        return array_filter(get_object_vars($this), function ($var) {
            return !is_null($var);
        });
    }

    public function addParagraph($text, ADFMarkType $markType = null)
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
}
