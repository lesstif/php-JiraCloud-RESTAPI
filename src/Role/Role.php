<?php

namespace JiraCloud\Role;

use JiraCloud\ClassSerialize;
use JiraCloud\Issue\Reporter;

class Role
{
    use ClassSerialize;

    public string $name;
    public int $id;
    public string $description;
    public string $self;

    public array $actors;

}
