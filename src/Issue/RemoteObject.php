<?php

namespace JiraCloud\Issue;

class RemoteObject
{
    public string $url;

    public string $title;

    public ?string $summary;

    public ?array $icon;

    /**
     * @var array|null
     *
     * ```json
     * "status": {
     *      "resolved": true,
     *      "icon": {
     *          "url16x16": "http://www.mycompany.com/support/resolved.png",
     *          "title": "Case Closed",
     *          "link": "http://www.mycompany.com/support?id=1&details=closed"
     *      }
     *  }
     * ```
     */
    public ?array $status;
}
