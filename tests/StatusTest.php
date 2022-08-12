<?php

namespace JiraCloud\Test;

use JiraCloud\Status\Status;
use PHPUnit\Framework\TestCase;
use JiraCloud\Status\StatusService;

class StatusTest extends TestCase
{
    public function testStatus()
    {
        $statusService = new StatusService();
        $statuses = $statusService->getAll();
        foreach ($statuses as $s) {
            $this->assertTrue($s instanceof Status);
            $this->assertTrue(!empty($s->name) > 0);
            $this->assertTrue(!empty($s->id));
        }
    }
}
