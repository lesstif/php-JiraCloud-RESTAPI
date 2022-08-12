<?php

namespace JiraCloud\ADF;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/strong/
 */
enum ADFMarkType
{
    case code;
    case strong;
    case em;
    case link;
    case strike;
    case subsup;
    case textColor;
    case underline;

    // return enum name as string
    public function name(): string
    {
        return match($this) {
            ADFMarkType::code => 'code',
            ADFMarkType::strong => 'strong',
            ADFMarkType::em => 'em',
            ADFMarkType::link => 'link',
            ADFMarkType::strike => 'strike',
            ADFMarkType::subsup => 'subsup',
            ADFMarkType::textColor => 'textColor',
            ADFMarkType::underline => 'underline',
        };
    }
}