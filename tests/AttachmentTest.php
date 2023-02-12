<?php

namespace JiraCloud\Test;

use HttpException;
use PHPUnit\Framework\TestCase;
use JiraCloud\Attachment\AttachmentService;
use JiraCloud\JiraException;

class AttachmentTest extends TestCase
{
    /**
     * @test
     * @throws \JsonMapper_Exception
     */
    public function get_attachment_by_id() : string
    {
        $attachmentId = '12643';

        try {
            $atts = new AttachmentService();

            $att = $atts->get($attachmentId, "output", true);

            dump($att);

        } catch (JiraException $e) {
            $this->fail('Create Failed : '.$e->getMessage());
        }

        return $attachmentId;
    }

    /**
     * @test
     * @depends get_attachment_by_id
     */
    public function remove_attachment(string $attachmentId) : string
    {
        try {
            $atts = new AttachmentService();

            $atts->remove($attachmentId);

            $this->assertGreaterThan(0, 1);

        } catch (JiraException $e) {
            $this->fail($e->getMessage());
        }

        return $attachmentId;
    }


}
