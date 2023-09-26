<?php

namespace JiraCloud\Priority;

use JiraCloud\Issue\Priority;

/**
 * Class to query priority.
 */
class PriorityService extends \JiraCloud\JiraClient
{
    private $uri = '/priority';

    /**
     * Function to get all priorities.
     *
     * @throws \JiraCloud\JiraException
     * @throws \JsonMapper_Exception
     *
     * @return array Priority class
     */
    public function getAll()
    {
        $ret = $this->exec($this->uri, null);

        $this->log->info("Result=\n".$ret);

        $priorityData = json_decode($ret);
        $priorities = [];

        foreach ($priorityData as $priority) {
            $priorities[] = $this->json_mapper->map($priority, new Priority());
        }

        return $priorities;
    }

    /**
     *  get specific priority info.
     *
     * @param string|int $priorityId priority id
     *
     * @throws \JsonMapper_Exception
     * @throws \JiraCloud\JiraException
     *
     * @return \JiraCloud\Issue\Priority
     */
    public function get($priorityId)
    {
        $ret = $this->exec($this->uri."/$priorityId", null);

        $this->log->info("Result=\n".$ret);

        $priority = $this->json_mapper->map(json_decode($ret), new Priority());

        return $priority;
    }
}
