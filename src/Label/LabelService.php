<?php

namespace JiraCloud\Label;

class LabelService extends \JiraCloud\JiraClient
{
    private $uri = '/label';

    /**
     * get all label list.
     *
     * @param array $paramArray
     *
     * @throws \JiraCloud\JiraException
     *
     * @return LabelSearchResult array of Label class
     */
    public function getAllLabels($paramArray = [])
    {
        $ret = $this->exec($this->uri.$this->toHttpQueryParameter($paramArray), null);

        return $this->json_mapper->map(
            json_decode($ret, false),
            LabelSearchResult::class
        );
    }
}
