<?php

namespace JiraCloud\Issue;

use DateTimeInterface;
use JiraCloud\ADF\AtlassianDocumentFormat;
use JiraCloud\ClassSerialize;
use JiraCloud\JiraException;

/**
 * Class Worklog.
 */
class Worklog
{
    use ClassSerialize;
    use VisibilityTrait;

    /* id of worklog  */
    public int $id;

    /*  api link of worklog */
    public string $self;

    /* details about author */
    public array $author;

    public array $updateAuthor;

    public string $updated;

    public string $timeSpent;

    public AtlassianDocumentFormat $comment;

    public string $started;

    public int $timeSpentSeconds;

    public Visibility $visibility;

    #[\ReturnTypeWillChange]
    public function jsonSerialize() : array
    {
        return array_filter(get_object_vars($this));
    }

    /**
     * Function to set comments.
     */
    public function setComment(AtlassianDocumentFormat $comment) : static
    {
        $this->comment = $comment;

        return $this;
    }

    // Note that in the docblock below, you cannot replace `mixed` by `\DateTimeInterface|string` because JsonMapper doesn't support that,
    // see <https://github.com/cweiske/jsonmapper/issues/64#issuecomment-269545585>.

    /**
     * @param DateTimeInterface|string $started started time value(\DateTimeInterface|string)  e.g. -  new \DateTime("2016-03-17 11:15:34") or "2016-03-17 11:15:34"
     * @return $this
     * @throws JiraException
     */
    public function setStarted(DateTimeInterface|string $started) : static
    {
        if (is_string($started)) {
            $dt = new \DateTime($started);
        } elseif ($started instanceof \DateTimeInterface) {
            $dt = $started;
        } else {
            throw new JiraException('field only accept date string or DateTimeInterface object.'.get_class($started));
        }

        // workround micro second
        $this->started = $dt->format("Y-m-d\TH:i:s").'.000'.$dt->format('O');

        return $this;
    }

    /**
     * Function to set start time of worklog.
     *
     * @param \DateTimeInterface $started e.g. -  new \DateTime("2014-04-05 16:00:00")
     *
     * @return Worklog
     */
    public function setStartedDateTime(DateTimeInterface $started) : static
    {
        // workround micro second
        $this->started = $started->format("Y-m-d\TH:i:s").'.000'.$started->format('O');

        return $this;
    }

    /**
     * Function to set worklog time in string.
     *
     * @param string $timeSpent
     *
     */
    public function setTimeSpent(string $timeSpent) : static
    {
        $this->timeSpent = $timeSpent;

        return $this;
    }

    /**
     * Function to set worklog time in seconds.
     *
     * @param int $timeSpentSeconds
     *
     * @return Worklog
     */
    public function setTimeSpentSeconds(int $timeSpentSeconds) : static
    {
        $this->timeSpentSeconds = $timeSpentSeconds;

        return $this;
    }
}
