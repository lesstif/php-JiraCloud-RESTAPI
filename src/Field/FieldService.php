<?php

namespace JiraCloud\Field;

use JiraCloud\Issue\IssueService;

class FieldService extends \JiraCloud\JiraClient
{
    private $uri = '/field';

    /**
     * get all field list.
     *
     * @throws \JiraCloud\JiraException
     *
     * @return array of Filed class
     */
    public function getAllFields($fieldType = Field::BOTH)
    {
        $ret = $this->exec($this->uri, null);

        $fields = $this->json_mapper->mapArray(
            json_decode($ret, false),
            new \ArrayObject(),
            '\JiraCloud\Field\Field'
        );

        // temp array
        $ar = [];
        if ($fieldType === Field::CUSTOM) {
            foreach ($fields as $f) {
                if ($f->custom === true) {
                    array_push($ar, $f);
                }
            }
            $fields = &$ar;
        } elseif ($fieldType === Field::SYSTEM) {
            foreach ($fields as $f) {
                if ($f->custom === false) {
                    array_push($ar, $f);
                }
            }
            $fields = &$ar;
        }

        return $fields;
    }

    /**
     * Returned if the Custom Field Option exists and is visible by the calling user.
     *
     * Currently, JIRA doesn't provide a method to retrieve custom field's option. instead use getEditMeta().
     *
     * @see IssueService::getEditMeta() .
     *
     * @param string $id custom field option id
     *
     * @throws \JiraCloud\JiraException
     *
     * @return \stdClass
     */
    public function getCustomFieldOption($id): \stdClass
    {
        $ret = $this->exec('/customFieldOption/'.$id);

        $this->log->debug("get custom Field Option=\n".$ret);

        return json_decode($ret);
    }

    /**
     * create new field.
     *
     * @param Field $field object of Field class
     *
     * @throws \JiraCloud\JiraException
     * @throws \JsonMapper_Exception
     *
     * @return Field created field class
     */
    public function create(Field $field)
    {
        $data = json_encode($field);

        $this->log->info("Create Field=\n".$data);

        $ret = $this->exec($this->uri, $data, 'POST');

        $cf = $this->json_mapper->map(
            json_decode($ret),
            new Field()
        );

        return $cf;
    }

    /**
     * @param int $fieldId The custom field Id
     *
     * @throws \JiraCloud\JiraException
     *
     * @return string|bool
     */
    public function getCustomFieldContexts(int $fieldId)
    {
        $url = sprintf('%s/customfield_%s/contexts', $this->uri, $fieldId);
        $ret = $this->exec($url);

        $this->log->debug("get custom Field Contexts=\n".$ret);

        return $ret;
    }

    /**
     * Get a custom fields options.
     *
     * @param int   $fieldId    The custom field Id
     * @param int   $contextId  Context ID related to the custom field
     * @param array $paramArray Query parameters like 'startAt' and 'maxResults'
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issue-custom-field-options/#api-rest-api-3-field-fieldid-context-contextid-option-get
     *
     * @throws \JiraCloud\JiraException
     *
     * @return string
     */
    public function getCustomFieldOptions(int $fieldId, int $contextId, array $paramArray = [])
    {
        $url = sprintf('%s/customfield_%s/context/%s/option%s', $this->uri, $fieldId, $contextId, $this->toHttpQueryParameter($paramArray));
        $ret = $this->exec($url);

        $this->log->debug("get custom Field Options=\n".$ret);

        return $ret;
    }

    /**
     * Create custom field options.
     *
     * @param int   $fieldId   The custom field Id to add options to
     * @param int   $contextId Context ID related to the custom field
     * @param array $options   The options array
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issue-custom-field-options/#api-rest-api-3-field-fieldid-context-contextid-option-post
     *
     * @throws \JiraCloud\JiraException
     *
     * @return string
     */
    public function createCustomFieldOptions(int $fieldId, int $contextId, array $options = [])
    {
        $url = sprintf('%s/customfield_%s/context/%s/option', $this->uri, $fieldId, $contextId);
        $ret = $this->exec($url, json_encode($options), 'POST');

        $this->log->debug("create custom Field Options=\n".$ret);

        return $ret;
    }

    /**
     * Update a custom field options.
     *
     * @param int   $fieldId   The custom field Id
     * @param int   $contextId Context ID related to the custom field
     * @param array $options   The new options array
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issue-custom-field-options/#api-rest-api-3-field-fieldid-context-contextid-option-put
     *
     * @throws \JiraCloud\JiraException
     *
     * @return string
     */
    public function updateCustomFieldOptions(int $fieldId, int $contextId, array $options = [])
    {
        $url = sprintf('%s/customfield_%s/context/%s/option', $this->uri, $fieldId, $contextId);
        $ret = $this->exec($url, json_encode($options), 'PUT');

        $this->log->debug("update custom Field Options=\n".$ret);

        return $ret;
    }
}
