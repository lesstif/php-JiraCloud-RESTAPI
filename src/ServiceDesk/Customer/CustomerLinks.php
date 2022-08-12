<?php

declare(strict_types=1);

namespace JiraCloud\ServiceDesk\Customer;

use JiraCloud\ClassSerialize;
use JiraCloud\ServiceDesk\DataObjectTrait;
use JsonSerializable;

class CustomerLinks implements JsonSerializable
{
    use ClassSerialize;
    use DataObjectTrait;

    public string $jiraRest;
    public object $avatarUrls;
}
