<?php

namespace JiraCloud\ADF;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/listItem/
 */
enum ADFListItemTypes
{
    case ORDERED_LIST;
    case BULLET_LIST;
    case em;
    case link;
    case strike;
    case subsup;
    case textColor;
    case underline;

    // return enum name as string
    public function name(): string
    {
        return match ($this) {
            ADFListItemTypes::ORDERED_LIST      => 'orderedList',
            ADFListItemTypes::BULLET_LIST    => 'bulletList',
        };
    }
}
