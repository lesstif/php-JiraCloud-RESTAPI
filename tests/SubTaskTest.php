<?php

namespace JiraCloud\Test;

use PHPUnit\Framework\TestCase;
use JiraCloud\Issue\IssueField;
use JiraCloud\Issue\IssueService;
use JiraCloud\JiraException;

class SubTaskTest extends TestCase
{
    public $issueKey = 'TEST-143';

    public function testCreateSubTask()
    {
        try {
            $issueField = new IssueField();

            $issueField->setProjectKey('TEST')
                ->setSummary("Subtask - something's wrong")
                ->setAssigneeName('lesstif')
                ->setPriorityName('Critical')
                ->setIssueType('Sub-task')
                ->setDescription('Subtask - Full description for issue')
                ->addVersion('1.0.1')
                ->addVersion('1.0.3')
                ->setParentKeyOrId($this->issueKey);

            $issueService = new IssueService();

            $ret = $issueService->create($issueField);

            //If success, Returns a link to the created issue.
            print_r($ret);

            $issueKey = $ret->{'key'};

            return $issueKey;
        } catch (JiraException $e) {
            $this->assertTrue(false, 'Create Failed : '.$e->getMessage());
        }
    }
}
