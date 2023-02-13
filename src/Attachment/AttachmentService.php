<?php

namespace JiraCloud\Attachment;

use JiraCloud\Issue\Attachment;
use JiraCloud\JiraException;

/**
 * Class AttachmentService.
 */
class AttachmentService extends \JiraCloud\JiraClient
{
    private $uri = '/attachment/';

    /**
     * Returns the meta-data for an attachment, including the URI of the actual attached file.
     *
     * @param int|string $id attachment Id
     * @outDir string downloads the content and store into outDir
     * @overwrite boolean determines whether to overwrite the file if it already exists.
     * @mode int outDir creation mode.
     * @recursive boolean Allows the creation of nested directories specified in the pathname.
     *
     *@throws JiraException
     * @throws \JsonMapper_Exception
     *
     *@return Attachment
     */
    public function get(int|string $id, string $outDir = null, bool $overwrite = false, int $mode = 0777, bool $recursive = true): Attachment
    {
        $ret = $this->exec($this->uri.$id, null);

        $this->log->info("Result=\n".$ret);

        $attachment = $this->json_mapper->map(
            json_decode($ret),
            new Attachment()
        );

        if ($outDir == null) {
            return $attachment;
        }

        // download contents
        if (!file_exists($outDir)) {
            mkdir($outDir, $mode, $recursive);
        }

        // extract filename
        $file = substr(strrchr($attachment->content, '/'), 1);

        if (file_exists($outDir.DIRECTORY_SEPARATOR.$file) && $overwrite == false) {
            return $attachment;
        }

        $this->download($attachment->content, $outDir, $file);

        return $attachment;
    }

    /**
     * Remove an attachment from an issue.
     *
     * @param int|string $id attachment id
     *
     *@throws JiraException
     *
     * @return string
     */
    public function remove(int|string $id): string
    {
        $ret = $this->exec($this->uri.$id, null, 'DELETE');

        $this->log->info("Result=\n".$ret);

        return $ret;
    }
}
