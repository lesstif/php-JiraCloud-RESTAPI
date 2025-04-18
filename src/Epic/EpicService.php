<?php

namespace JiraCloud\Epic;

use JiraCloud\Configuration\ConfigurationInterface;
use JiraCloud\Issue\AgileIssue;
use Psr\Log\LoggerInterface;

class EpicService extends \JiraCloud\JiraClient
{
    private $uri = '/epic';
    private $version = '1.0';

    public function __construct(?ConfigurationInterface $configuration = null, ?LoggerInterface $logger = null, $path = './')
    {
        parent::__construct($configuration, $logger, $path);
        $this->setAPIUri('/rest/agile/'.$this->version);
    }

    public function getEpic($id, $paramArray = []): ?Epic
    {
        $response = $this->exec($this->uri.'/'.$id.$this->toHttpQueryParameter($paramArray), null);

        try {
            return $this->json_mapper->map(
                json_decode($response, false, 512, $this->getJsonOptions()),
                new Epic()
            );
        } catch (\JsonException $exception) {
            $this->log->error("Response cannot be decoded from json\nException: {$exception->getMessage()}");

            return null;
        }
    }

    /**
     * @return \ArrayObject|AgileIssue[]|null
     */
    public function getEpicIssues($id, $paramArray = []): ?\ArrayObject
    {
        $response = $this->exec($this->uri.'/'.$id.'/issue'.$this->toHttpQueryParameter($paramArray), null);

        try {
            return $this->json_mapper->mapArray(
                json_decode($response, false, 512, $this->getJsonOptions())->issues,
                new \ArrayObject(),
                AgileIssue::class
            );
        } catch (\JsonException $exception) {
            $this->log->error("Response cannot be decoded from json\nException: {$exception->getMessage()}");

            return null;
        }
    }
}
