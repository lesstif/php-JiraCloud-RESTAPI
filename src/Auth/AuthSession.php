<?php

namespace JiraCloud\Auth;

use JiraCloud\ClassSerialize;

class AuthSession implements \JsonSerializable
{
    use ClassSerialize;

    /**
     * @var \JiraCloud\Auth\SessionInfo
     */
    public $session;

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
