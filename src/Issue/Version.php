<?php

namespace JiraCloud\Issue;

use DateTimeInterface;

class Version implements \JsonSerializable
{
    public string $self;

    public string $id;

    /** Version name: ex: 4.2.3 */
    public ?string $name;

    /** version description: ex; improvement performance */
    public ?string $description;

    public bool $archived;

    public bool $released;

    public string $releaseDate;

    public bool $overdue;

    public ?string $userReleaseDate;

    public string $projectId;

    public ?string $startDate;
    public ?string $userStartDate;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    public function setProjectId(string $id): static
    {
        $this->projectId = $id;

        return $this;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function setArchived(bool $archived): static
    {
        $this->archived = $archived;

        return $this;
    }

    public function setReleased(bool $released): static
    {
        $this->released = $released;

        return $this;
    }

    public function setReleaseDateAsDateTime(DateTimeInterface $releaseDate, string $format = 'Y-m-d'): static
    {
        $this->releaseDate = $releaseDate->format($format);

        return $this;
    }

    public function setReleaseDateAsString(string $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function setUserReleaseDate(string $userReleaseDate): static
    {
        $this->userReleaseDate = $userReleaseDate;

        return $this;
    }

    public function setStartDateAsDateTime(\DateTimeInterface $startDate, string $format = 'Y-m-d'): static
    {
        $this->startDate = $startDate->format($format);

        return $this;
    }

    public function setStartDateAsString(?string $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function setUserStartDateAsDateTime(\DateTimeInterface $userStartDate, string $format = 'Y-m-d'): static
    {
        $this->userStartDate = $userStartDate->format($format);

        return $this;
    }

    public function setUserStartDateAsString(?string $userStartDate): static
    {
        $this->userStartDate = $userStartDate;

        return $this;
    }
}
