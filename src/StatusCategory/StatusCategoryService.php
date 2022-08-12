<?php

namespace JiraCloud\StatusCategory;

use JiraCloud\Issue\Statuscategory;
use JiraCloud\JiraException;
use JsonMapper_Exception;

class StatusCategoryService extends \JiraCloud\JiraClient
{
    private $uri = '/statuscategory';

    /**
     * get all statuscategorys.
     *
     * @throws JiraException
     * @throws JsonMapper_Exception
     *
     * @return Statuscategory[] array of Project class
     */
    public function getAll()
    {
        $ret = $this->exec($this->uri.'/', null);
        $this->log->info("Result=\n".$ret);

        return $this->json_mapper->mapArray(
            json_decode($ret, false),
            new \ArrayObject(),
            \JiraCloud\Issue\Statuscategory::class
        );
    }
}
