<?php

namespace JiraCloud\Test;

use PHPUnit\Framework\TestCase;
use JiraCloud\Attachment\AttachmentService;
use JiraCloud\JiraException;

class AttachmentTest extends TestCase
{
    public function testGetAttachment()
    {
        $attachmentId = 12643;

        try {
            $atts = new AttachmentService();

            $att = $atts->get($attachmentId, "output", true);

            dump($att);

            return $attachmentId;
        } catch (JiraException $e) {
            $this->assertTrue(false, 'Create Failed : '.$e->getMessage());
        }
    }

    /**
     * @depends testGetAttachment
     */
    public function testRemoveAttachment($attachmentId)
    {
        try {
            $atts = new AttachmentService();

            $atts->remove($attachmentId);

            $this->assertGreaterThan(0, count(1));

        } catch (HTTPException $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }


}
