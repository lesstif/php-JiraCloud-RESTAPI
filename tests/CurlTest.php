<?php

namespace JiraCloud\Test;

use PHPUnit\Framework\TestCase;
use JiraCloud\HTTPException;

class CurlTest extends TestCase
{
    public function testCurlPost()
    {
        $this->markTestIncomplete();
        try {
            $config = getHostConfig();

            $config['host'] = 'http://requestb.in/vqid8qvq';

            $j = new \JiraCloud\JiraClient($config, getOptions());

            $post_data = ['name' => 'value'];

            $http_status = 0;
            $ret = $j->exec('/', json_encode($post_data), $http_status);

            var_dump($ret);
            $this->assertTrue(true);
        } catch (HTTPException $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }
}
