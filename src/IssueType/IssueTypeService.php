<?php

namespace JiraCloud\IssueType;

use JiraCloud\Issue\IssueType;
use JiraCloud\JiraException;
use JsonMapper_Exception;

class IssueTypeService extends \JiraCloud\JiraClient
{
    private $uri = '/issuetype';

    /**
     * get all issuetypes.
     *
     * @throws JiraException
     * @throws JsonMapper_Exception
     *
     * @return IssueType[] array of Project class
     */
    public function getAll()
    {
        $ret = $this->exec($this->uri.'/', null);
        $this->log->info("Result=\n".$ret);

        return $this->json_mapper->mapArray(
            json_decode($ret, false),
            new \ArrayObject(),
            IssueType::class
        );
    }
}
