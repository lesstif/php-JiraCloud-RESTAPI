<?php

namespace JiraCloud\ADF;

use DH\Adf\Node\Block\Document;
use DH\Adf\Node\Node;

/**
 * Class AtlassianDocumentFormat.
 */
class AtlassianDocumentFormat implements \JsonSerializable
{
    public array $type;

    public array $content;

    public string $version;

    private Document $document;

    public function __construct(Document|Node $document)
    {
        $this->document = $document;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return $this->document->jsonSerialize();
    }

    public function setDocument(Document|Node $document)
    {
        $this->document = $document;
    }
}
