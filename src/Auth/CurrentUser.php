<?php

namespace JiraCloud\Auth;

use JiraCloud\ClassSerialize;

class CurrentUser implements \JsonSerializable
{
    use ClassSerialize;

    /**
     * @var string
     */
    public $self;

    /**
     * @var string
     */
    public $name;

    /**
     * @var \JiraCloud\Auth\LoginInfo
     */
    public $loginInfo;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
