<?php

namespace JiraCloud\Test;

use JsonMapper;
use PHPUnit\Framework\TestCase;
use JiraCloud\Issue\Comment;
use JiraCloud\Issue\Issue;
use JiraCloud\Issue\IssueField;
use JiraCloud\Issue\Reporter;
use JiraCloud\Issue\SecurityScheme;
use \Mockery as m;

class MapperTest extends TestCase
{
    /** @var JsonMapper */
    public $mapper;

    public function setUp(): void
    {
        $this->mapper = new JsonMapper();
        $this->mapper->undefinedPropertyHandler = [new \JiraCloud\JsonMapperHelper(), 'setUndefinedProperty'];
        $this->mapper->classMap['\\'.\DateTimeInterface::class] = \DateTime::class;
    }

    public function tearDown(): void
    {
        $this->mapper = null;
        m::close();
    }

    public function testComment()
    {
        $ret = file_get_contents('test-data/comment.json');

        $comment = $this->mapper->map(
            json_decode($ret), new Comment()
        );

        $this->assertInstanceOf(Comment::class, $comment);

        $this->assertEquals('johndoe@example.com', $comment->author->emailAddress);
        $this->assertEquals('KwangSeob Jeong', $comment->updateAuthor->name);
    }

    public function testIssueField()
    {
        $ret = file_get_contents('test-data/issueField.json');

        $issueField = $this->mapper->map(
            json_decode($ret), new IssueField()
        );

        $this->assertInstanceOf(IssueField::class, $issueField);

        $this->assertInstanceOf(Reporter::class, $issueField->assignee);
        $this->assertEquals('lesstif@gmail.com', $issueField->assignee->emailAddress);

        $this->assertInstanceOf(SecurityScheme::class, $issueField->security);
        $this->assertEquals(12345, $issueField->security->id);
    }

    public function testIssue()
    {
        $ret = file_get_contents('test-data/issue.json');

        $is = new \JiraCloud\Issue\IssueService();
        $issue = $this->mapper->map(
                json_decode($ret), new Issue()
            );

        $this->assertInstanceOf(Issue::class, $issue);

        $this->assertTrue(is_array($issue->renderedFields));
        $this->assertArrayHasKey('description', $issue->renderedFields);
        $this->assertEquals(10000, $issue->renderedFields['attachment'][0]->id);

        $this->assertTrue(is_array($issue->names));
        $this->assertArrayHasKey('issuetype', $issue->names);
        $this->assertArrayHasKey('timespent', $issue->names);

        $this->assertTrue(is_array($issue->schema));
        $this->assertArrayHasKey('fixVersions', $issue->schema);
        $this->assertEquals('array', $issue->schema['fixVersions']->type);

        $this->assertTrue(is_array($issue->transitions));
        $this->assertLessThan(3, count($issue->transitions));
        $this->assertEquals('작업 시작', $issue->transitions[0]->name);

    }

    public function testApiV3()
    {
        $ret = file_get_contents('test-data/issueFieldV3.json');

        $issue = $this->mapper->map(
            json_decode($ret), new \JiraCloud\Issue\IssueV3()
        );

        $this->assertInstanceOf(\JiraCloud\Issue\IssueV3::class, $issue);

        $field = $issue->fields;

        $this->assertInstanceOf(\JiraCloud\Issue\IssueFieldV3::class, $field);

        $this->assertInstanceOf(\JiraCloud\ADF\DescriptionV3::class, $field->description);

        $this->assertEquals(1, $field->description->version);

        $this->assertObjectHasAttribute('id', $field->reporter);

        $this->assertEquals(1, $field->environment->version);

        //$this->assertTrue(is_array($issue->schema));
        $this->assertArrayHasKey(0, $field->versions);
        $this->assertObjectHasAttribute('id', $field->versions[0]);

        $this->assertObjectHasAttribute('id', $field->assignee);
        $this->assertGreaterThanOrEqual(1, count($field->environment->content));
        $this->assertObjectHasAttribute('id', $field->security);

        $this->assertObjectHasAttribute('labels', $field);
        $this->assertEquals('bugfix', $field->labels[0]);

        //$this->assertObjectHasAttribute('remainingEstimate', $field->timetracking);
        //$this->assertEquals(5, $field->timetracking->remainingEstimate);
    }
}
