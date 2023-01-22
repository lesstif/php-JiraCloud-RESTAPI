<?php

namespace JiraCloud\Test;

use DateInterval;
use DateTime;
use JiraCloud\Sprint\Sprint;
use JiraCloud\Sprint\SprintService;
use PHPUnit\Framework\TestCase;
use JiraCloud\Dumper;
use JiraCloud\Issue\Comment;
use JiraCloud\Issue\IssueService;
use JiraCloud\JiraException;

class SPrintTest extends TestCase
{
    /**
     * @test
     *
    */
    public function create_sprint() : int
    {
        $start = (new DateTime('NOW'))->add(DateInterval::createFromDateString('1 month 5 day'));

        $sp = (new Sprint())
                ->setNameAsString("My Sprint 1")
                ->setGoalAsString("goal")
                ->setOriginBoardIdAsStringOrInt(2)
                ->setStartDateAsDateTime($start)
                ->setEndDateAsDateTime($start->add(DateInterval::createFromDateString('3 week')))
        ;

        try {
            $sps = new SprintService();

            $sprint = $sps->createSprint($sp);

            $this->assertNotNull($sprint->name);

            return $sprint->id;

        } catch (JiraException $e) {
            $this->assertTrue(false, 'testSearch Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     *
     * @depends create_sprint
     *
     * @throws \JsonMapper_Exception
     */
    public function get_sprints(int $sprintId) : int
    {
        try {
            $sps = new SprintService();

            $sprint = $sps->getSprint($sprintId);

            $this->assertNotNull($sprint->name);
            Dumper::dump($sprint);

            return $sprintId;
        } catch (JiraException $e) {
            $this->assertTrue(false, 'testSearch Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends get_sprints
     *
     * @param int $sprintId
     * @return void
     */
    public function get_issues_in_sprints(int $sprintId)
    {
        try {
            $sps = new SprintService();

            $sprint = $sps->getSprintIssues($sprintId);

            $this->assertNotNull($sprint);
            Dumper::dump($sprint);
        } catch (JiraException $e) {
            $this->assertTrue(false, 'testSearch Failed : '.$e->getMessage());
        }
    }
}
