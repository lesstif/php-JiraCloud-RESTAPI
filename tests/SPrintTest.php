<?php

namespace JiraCloud\Test;

use DateInterval;
use DateTime;
use Exception;
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
        $sprintStartDate = (new DateTime('NOW'))->add(DateInterval::createFromDateString('1 month 5 day'));

        $sprintBoardId = 2;

        $sp = (new Sprint())
                ->setOriginBoardIdAsStringOrInt($sprintBoardId)
                ->setNameAsString("My Sprint 1")
                ->setGoalAsString("Sprint 1 Goal")
                ->setStartDateAsDateTime($sprintStartDate)
                ->setEndDateAsDateTime($sprintStartDate->add(DateInterval::createFromDateString('3 week')))
        ;

        try {
            $sps = new SprintService();

            $sprint = $sps->createSprint($sp);

            $this->assertNotNull($sprint->name);

            return $sprint->id;

        } catch (Exception $e) {
            $this->fail( 'create_sprint Failed : '.$e->getMessage());
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

            return $sprintId;
        } catch (Exception $e) {
            $this->fail('get_sprints Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends get_sprints
     *
     * @param int $sprintId
     * @return int
     */
    public function get_issues_in_sprints(int $sprintId) : int
    {
        try {
            $sps = new SprintService();

            $sprint = $sps->getSprintIssues($sprintId);

            $this->assertNotNull($sprint);

            return $sprintId;
        } catch (Exception $e) {
            $this->fail('get_issues_in_sprints Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends get_issues_in_sprints
     *
     * @param int $sprintId
     * @return int
     */
    public function move_issues_to_sprints(int $sprintId) : int
    {
        try {
            $sp = (new Sprint())
                ->setMoveIssues([
                    "MOBL-1",
                    "MOBL-5",
                ])

            ;

            $sps = new SprintService();

            $sprint = $sps->moveIssues2Sprint($sprintId, $sp);

            $this->assertNotNull($sprint);

            return $sprintId;
        } catch (Exception $e) {
            $this->fail('move_issues_to_sprints Failed : '.$e->getMessage());
        }
    }
}
