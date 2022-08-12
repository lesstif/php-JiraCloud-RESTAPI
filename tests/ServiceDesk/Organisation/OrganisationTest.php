<?php

declare(strict_types=1);

namespace JiraCloud\Test\ServiceDesk\Organisation;

use JiraCloud\ServiceDesk\Organisation\Organisation;
use PHPUnit\Framework\TestCase;

class OrganisationTest extends TestCase
{
    public function testSetLinks(): void
    {
        $links = [
            'http://example.com',
            'http://example2.com',
        ];

        $uut = new Organisation();
        $uut->setLinks($links);

        self::assertSame($links, $uut->_links);
    }
}
