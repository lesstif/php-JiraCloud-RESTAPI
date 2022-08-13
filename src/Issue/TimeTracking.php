<?php
namespace JiraCloud\Issue;

use JiraCloud\ClassSerialize;

/**
 * Class TimeTracking.
 */
class TimeTracking implements \JsonSerializable
{
    use ClassSerialize;

    /**
     * Original estimate.(ex 90m, 2h, 1d 2h 30m)
     */
    public string $originalEstimate;

    /**
     * Remaining estimate.(ex 90m, 2h, 1d 2h 30m)
     */
    public string $remainingEstimate;

    /**
     * Time spent. (ex 90m, 2h, 1d 2h 30m)
     */
    public string $timeSpent;

    /**
     * Original estimate in seconds, generated in jira
     * for create/update issue set $this->originalEstimate.
     *
     */
    public int $originalEstimateSeconds;

    /**
     * Remaining estimate in seconds, generated in jira
     * for create/update issue set $this->remainingEstimate.
     *
     */
    public int $remainingEstimateSeconds;

    /**
     * Time spent in seconds, generated in jira
     * for create/update issue set $this->timeSpent.
     *
     */
    public int $timeSpentSeconds;

    public function getOriginalEstimate() : string
    {
        return $this->originalEstimate;
    }

    public function setOriginalEstimate(string $originalEstimate) :void
    {
        $this->originalEstimate = $originalEstimate;
    }

    public function getRemainingEstimate() :string
    {
        return $this->remainingEstimate;
    }

    public function setRemainingEstimate(string $remainingEstimate)
    {
        $this->remainingEstimate = $remainingEstimate;
    }

    public function getTimeSpent() :string
    {
        return $this->timeSpent;
    }

    public function setTimeSpent(string $timeSpent)
    {
        $this->timeSpent = $timeSpent;
    }

    public function getOriginalEstimateSeconds() :int
    {
        return $this->originalEstimateSeconds;
    }

    public function setOriginalEstimateSeconds(int $originalEstimateSeconds)
    {
        $this->originalEstimateSeconds = $originalEstimateSeconds;
    }

    public function getRemainingEstimateSeconds() :int
    {
        return $this->remainingEstimateSeconds;
    }

    public function setRemainingEstimateSeconds(int $remainingEstimateSeconds)
    {
        $this->remainingEstimateSeconds = $remainingEstimateSeconds;
    }

    public function getTimeSpentSeconds() :int
    {
        return $this->timeSpentSeconds;
    }

    public function setTimeSpentSeconds(int $timeSpentSeconds)
    {
        $this->timeSpentSeconds = $timeSpentSeconds;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
