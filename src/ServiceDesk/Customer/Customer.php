<?php

declare(strict_types=1);

namespace JiraCloud\ServiceDesk\Customer;

use JiraCloud\ClassSerialize;
use JiraCloud\ServiceDesk\DataObjectTrait;
use JsonSerializable;

class Customer implements JsonSerializable
{
    use ClassSerialize;
    use DataObjectTrait;

    public string $key;
    public string $name;
    public string $accountId;
    public string $emailAddress;
    public string $displayName;
    public bool $active;
    public string $timeZone;
    public ?CustomerLinks $_links;
    public string $self;

    public function setLinks($links): void
    {
        if ($links === null) {
            return;
        }

        if (!$links instanceof CustomerLinks) {
            $data = $links;

            $links = new CustomerLinks();
            $links->jiraRest = $data['jiraRest'];
            $links->avatarUrls = $data['avatarUrls'];
        }

        $this->_links = $links;
    }
}
