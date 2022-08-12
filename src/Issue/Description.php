<?php

namespace JiraCloud\Issue;

use JiraCloud\ADF\ADFMarkType;

/**
 * REST API V3 Issue description field.
 *
 * Class Description
 */
class Description implements \JsonSerializable
{
    /* @var string */
    public $self;

    /* @var string */
    public $type = 'doc';

    /* @var integer */
    public $version = 1;

    public array $content = [];

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    public function addDescriptionParagraph($text, ADFMarkType $markType = null, $attrs = [])
    {
        if (empty($this->content['type'])){
            $this->content['type'] = 'paragraph';
        }

        if (!empty($attrs)) {
            $this->content['attrs'] = $attrs;
        }

        $c = [
            'type' => 'text',
            'text' => $text,
        ];

        if ($markType != null) {
            $c['marks'] = ['type' => $markType->name()];
        }

        $this->content['content'][] = $c;
    }
}
