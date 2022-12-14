<?php

namespace JiraCloud\Test;

use PHPUnit\Framework\TestCase;
use JiraCloud\Issue\IssueService;
use JiraCloud\Issue\TimeTracking;
use JiraCloud\JiraException;

class TimeTrackingTest extends TestCase
{
    private $issueKey = 'TEST-76';

    public function testGetTimeTracking()
    {
        try {
            $issueService = new IssueService();

            $ret = $issueService->getTimeTracking($this->issueKey);
            var_dump($ret);
        } catch (JiraException $e) {
            $this->assertTrue(false, 'testGetTimeTracking Failed : '.$e->getMessage());
        }
    }

    public function testPostTimeTracking()
    {
        $timeTracking = new TimeTracking();

        $timeTracking->setOriginalEstimate('3w 4d 6h');
        $timeTracking->setRemainingEstimate('1w 2d 3h');

        try {
            $issueService = new IssueService();

            $ret = $issueService->timeTracking($this->issueKey, $timeTracking);
            var_dump($ret);
        } catch (JiraException $e) {
            $this->assertTrue(false, 'testPostTimeTracking Failed : '.$e->getMessage());
        }
    }
}
