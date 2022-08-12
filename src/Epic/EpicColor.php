<?php

namespace JiraCloud\Epic;

use JiraCloud\JsonSerializableTrait;

class EpicColor implements \JsonSerializable
{
    use JsonSerializableTrait;

    public string $key;
}
