<?php

namespace JiraCloud\IssueLink;

use ArrayObject;

class IssueLinkService extends \JiraCloud\JiraClient
{
    private $uri = '';

    /**
     * @param IssueLink $issueLink
     *
     * @throws \JiraCloud\JiraException
     *
     * @return bool
     */
    public function addIssueLink(IssueLink $issueLink): bool
    {
        $this->log->info("addIssueLink=\n");

        $data = json_encode($issueLink);

        $this->log->debug("Create IssueLink=\n".$data);

        $url = $this->uri.'/issueLink';
        $type = 'POST';

        $ret = $this->exec($url, $data, $type);

        return $ret;
    }

    /**
     * @throws \JiraCloud\JiraException
     *
     * @return IssueLinkType[]
     * @phpstan-return ArrayObject<int, IssueLinkType>
     */
    public function getIssueLinkTypes(): ArrayObject
    {
        $this->log->info("getIssueLinkTYpes=\n");

        $url = $this->uri.'/issueLinkType';

        $ret = $this->exec($url);

        $data = json_encode(json_decode($ret)->issueLinkTypes);

        $linkTypes = $this->json_mapper->mapArray(
            json_decode($data, false),
            new \ArrayObject(),
            \JiraCloud\IssueLink\IssueLinkType::class
        );

        return $linkTypes;
    }

    /**
     * @param string $linkId
     *
     * @throws \JiraCloud\JiraException
     * @throws \JsonMapper_Exception
     *
     * @return IssueLink
     */
    public function getIssueLink(string $linkId): IssueLink
    {
        $this->log->info("getIssueLink=\n");

        $url = $this->uri.'/issueLink/'.$linkId;

        $ret = $this->exec($url);

        return $this->json_mapper->map(
            json_decode($ret),
            new IssueLink()
        );
    }

    public function deleteIssueLink(string $linkId): bool
    {
        $this->log->info("deleteIssueLink=\n");

        $url = $this->uri.'/issueLink/'.$linkId;

        $ret = $this->exec($url, '', 'DELETE');

        return $ret;
    }
}
