<?php

namespace JiraCloud\Issue;

class TransitionTo
{
    public string $self;

    public ?string $description;

    public string $iconUrl;

    /**
     * Closed, Resolved, etc..
     *
     */
    public string $name;

    public string $id;

    public array $statusCategory;
}
