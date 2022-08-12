<?php

declare(strict_types=1);

namespace JiraCloud\ServiceDesk\Request;

use DateTime;
use JiraCloud\ClassSerialize;
use JiraCloud\ServiceDesk\DataObjectTrait;
use JsonSerializable;

class RequestStatus implements JsonSerializable
{
    use ClassSerialize;
    use DataObjectTrait;

    public string $status;
    public DateTime $statusDate;

    public function setStatusDate(array $statusDate): void
    {
        $this->statusDate = new DateTime($statusDate['iso8601']);
    }
}
