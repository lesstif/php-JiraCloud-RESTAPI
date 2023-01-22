<?php

declare(strict_types=1);

namespace JiraCloud\Sprint;

use DateTimeInterface;
use JiraCloud\JsonSerializableTrait;

class Sprint implements \JsonSerializable
{
    use JsonSerializableTrait;

    public string $self;

    public int $id;

    public string $name;

    public string $state;
    public string $startDate;

    public string $endDate;

    public string $activatedDate;

    public string $completeDate;

    public int $originBoardId;

    public string $goal;

    public function setNameAsString(string $sprintName): self
    {
        $this->name = $sprintName;

        return $this;
    }

    public function setGoalAsString(string $sprintGoal): self
    {
        $this->goal = $sprintGoal;

        return $this;
    }

    public function setOriginBoardIdAsStringOrInt(string|int $originBoardId): self
    {
        $this->originBoardId = $originBoardId;

        return $this;
    }

    public function setStartDateAsDateTime(DateTimeInterface $startDate, $format = 'Y-m-d'): static
    {
        $this->startDate = $startDate->format($format);

        return $this;
    }

    public function setEndDateAsDateTime(DateTimeInterface $endDate, $format = 'Y-m-d'): static
    {
        $this->endDate = $endDate->format($format);

        return $this;
    }
}
