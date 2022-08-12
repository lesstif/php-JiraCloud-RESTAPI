<?php

namespace JiraCloud\Test;

use PHPUnit\Framework\TestCase;
use JiraCloud\Dumper;
use JiraCloud\Issue\IssueService;
use JiraCloud\JiraException;

class WatcherLogTest extends TestCase
{
    public $issueKey = 'TEST-315';

    public function testAddWatcherLog()
    {
        try {
            $issueService = new IssueService();

            // add issue watcher
            $ret = $issueService->addWatcher($this->issueKey, 'lesstif');

            Dumper::dump($ret);
        } catch (JiraException $e) {
            $this->assertTrue(false, 'testAddWatcherLog Failed : '.$e->getMessage());
        }
    }

    public function testRemoveWatcherLog()
    {
        try {
            $issueService = new IssueService();

            // remove issue watcher
            $ret = $issueService->removeWatcher($this->issueKey, 'lesstif');

            Dumper::dump($ret);
        } catch (JiraException $e) {
            $this->assertTrue(false, 'testRemoveWatcherLog Failed : '.$e->getMessage());
        }
    }
}
