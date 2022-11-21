<?php

namespace JiraCloud\Test;

use DateInterval;
use DateTime;
use DH\Adf\Node\Block\Document;
use JiraCloud\ADF\AtlassianDocumentFormat;
use PHPUnit\Framework\TestCase;
use JiraCloud\Issue\IssueService;
use JiraCloud\Issue\Worklog;
use JiraCloud\JiraException;

class WorkLogTest extends TestCase
{
    /**
     * @test
     *
     */
    public function get_workLog() : string
    {
        $issueKey = 'TEST-96';

        try {
            $issueService = new IssueService();

            // get issue's worklog
            $pwl = $issueService->getWorklog($issueKey);
            $worklogs = $pwl->getWorklogs();

            $this->assertNotNull($worklogs);

            return $issueKey;
        } catch (JiraException $e) {
            $this->fail('testGetWorkLog Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends get_workLog
     * @param string $issueKey
     * @return array workLogId
     * @throws \JsonMapper_Exception
     */
    public function add_workLog_In_Issue(string $issueKey) : array
    {
        try {
            $workLog = new Worklog();

            $code =<<<CODE
<?php
\$i = 123;
\$a = ['hello', 'world', ];
var_dump([\$i => \$a]);
CODE;

            $doc = (new Document())
                ->heading(1)            // header level 1, can have child blocks (needs to be closed with `->end()`)
                    ->text('h1')        // simple unstyled text, cannot have child blocks (no `->end()` needed)
                ->end()                 // closes `heading` node
                ->paragraph()           // paragraph, can have child blocks (needs to be closed with `->end()`)
                    ->text('we’re ')    // simple unstyled text
                    ->strong('support') // text node embedding a `strong` mark
                    ->text(' ')         // simple unstyled text
                    ->em('markdown')    // text node embedding a `em` mark
                    ->text('. ')        // simple unstyled text
                    ->underline('like') // text node embedding a `underline` mark
                    ->text(' this.')    // simple unstyled text
                ->end()                 // closes `paragraph` node
                ->heading(2)            // header level 2
                    ->text('h2')        // simple unstyled text
                ->end()                 // closes `heading` node
                ->heading(3)
                    ->text('heading 3')
                ->end()
                ->paragraph()           // paragraph
                    ->text('also support heading.') // simple unstyled text
                ->end()                 // closes `paragraph` node
                ->codeblock('php')
                    ->text($code)
                ->end()
            ;

            $comment = new AtlassianDocumentFormat($doc);

            $startedAt = (new DateTime('NOW'))
                ->add(DateInterval::createFromDateString('-1 hour -27 minute'));

            $workLog->setComment($comment)
                ->setStarted($startedAt)
                ->setTimeSpent('1d 2h 3m');

            $issueService = new IssueService();

            $ret = $issueService->addWorklog($issueKey, $workLog);

            $workLogid = $ret->{'id'};

            $this->assertNotNull($workLogid);

            return [$issueKey, $workLogid];
        } catch (JiraException $e) {
            $this->fail('Create Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends add_workLog_In_Issue
     * @param array $workLogid
     * @return string
     * @throws \JsonMapper_Exception
     */
    public function edit_workLog_In_Issue(array $param) :array
    {
        $issueKey  = $param[0];
        $workLogid = $param[1];
        try {
            $workLog = new Worklog();

            $doc = (new Document())
                ->heading(1)            // header level 1, can have child blocks (needs to be closed with `->end()`)
                ->text('h1')        // simple unstyled text, cannot have child blocks (no `->end()` needed)
                ->end()                 // closes `heading` node
                ->paragraph()           // paragraph, can have child blocks (needs to be closed with `->end()`)
                    ->text('I’did ')    // simple unstyled text
                    ->strong('edit') // text node embedding a `strong` mark
                    ->text(' ')         // simple unstyled text
                    ->em('previous')    // text node embedding a `em` mark
                    ->text(' ')        // simple unstyled text
                    ->underline('worklog') // text node embedding a `underline` mark
                    ->text(' here.')    // simple unstyled text
                ->end()                 // closes `paragraph` node
                ->heading(2)            // header level 2
                 ->text('h2')        // simple unstyled text
                ->end()                 // closes `heading` node
                ->heading(3)
                 ->text('heading 3')
                ->end()
                ->paragraph()           // paragraph
                 ->text('also support heading.') // simple unstyled text
                ->end()                 // closes `paragraph` node
            ;

            $comment = new AtlassianDocumentFormat($doc);

            $workLog->setComment($comment)
                ->setTimeSpent('2d 7h 5m');

            $issueService = new IssueService();

            $ret = $issueService->editWorklog($issueKey, $workLog, $workLogid);

            $workLogid = $ret->{'id'};

            $this->assertNotNull($workLogid);

            return [$issueKey, $workLogid];
        } catch (JiraException $e) {
            $this->fail('Create Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends edit_workLog_In_Issue
     * @param array $param
     * @return array
     * @throws \JsonMapper_Exception
     */
    public function get_workLog_by_Id(array $param) : array
    {
        $issueKey  = $param[0];
        $workLogid = $param[1];

        try {
            $issueService = new IssueService();

            $worklog = $issueService->getWorklogById($issueKey, $workLogid);

            $this->assertNotNull($worklog->id);

            return [$issueKey, $worklog->id];
        } catch (JiraException $e) {
            $this->fail('testGetWorkLogById Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends edit_workLog_In_Issue
     *
     * @param $workLogid
     * @return void
     */
    public function delete_WorkLog_By_Id(array $param)
    {
        $issueKey  = $param[0];
        $non_exist_work_log_id_for_retain_worklog = $param[1] * 3;

        try {
            $issueService = new IssueService();

            $result = $issueService->deleteWorklog($issueKey, $non_exist_work_log_id_for_retain_worklog);

        } catch (JiraException $e) {
            if ($e->getCode() === 404) {
                // expected result
                $this->assertNotNull(true);
            } else {
                $this->fail('delete_WorkLog_By_Id Failed : ' . $e->getMessage());
            }
        }
    }
}
