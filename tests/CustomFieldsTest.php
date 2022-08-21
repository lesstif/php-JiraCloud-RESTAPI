<?php

namespace JiraCloud\Test;

use PHPUnit\Framework\TestCase;
use JiraCloud\Dumper;
use JiraCloud\Field\Field;
use JiraCloud\Field\FieldService;
use JiraCloud\JiraException;

class CustomFieldsTest extends TestCase
{
    /**
     * @test
     * @return array
     */
    public function get_all_custom_fields() : array
    {
        try {
            $fieldService = new FieldService();

            $ret = $fieldService->getAllFields(Field::CUSTOM);

            //file_put_contents("custom-field.json", json_encode($ret, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));

            $ids = array_map(function($cf) {
                // extract custom field id
                    preg_match('/\d+/', $cf->id, $matches);
                    return $matches[0];
                }, $ret);

            $this->assertNotNull($ids);
            $this->assertIsArray($ids);

            return $ids;
        } catch (JiraException $e) {
            $this->fail('get_all_custom_fields Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends get_all_custom_fields
     *
     * @param array $ids
     */
    public function get_customer_field_options(array $ids) :void
    {
        try {
            $fieldService = new FieldService();

            foreach ($ids as $id) {
                try {
                    $ret = $fieldService->getCustomFieldOption($id);

                    $this->assertNotNull($ret->self);
                }catch (JiraException $e) {}
            }
        } catch (JiraException $e) {
            $this->fail('get_customer_field_options Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends get_customer_field_options
     * @return string
     * @throws \JsonMapper_Exception
     */
    public function create_customer_field() : string
    {
        //$this->markTestSkipped();
        try {
            $field = new Field();

            $field->setName('다중 선택이')
                ->setDescription('Custom field for picking groups')
                ->setType("com.atlassian.jira.plugin.system.customfieldtypes:cascadingselect")
            //    ->setSearcherKey('com.atlassian.jira.plugin.system.customfieldtypes:grouppickersearcher')
            ;

            $fieldService = new FieldService();

            $ret = $fieldService->create($field);

            return $ret->id;
        } catch (JiraException $e) {
            $this->fail('create_customer_field Failed : '.$e->getMessage());
        }
    }

    /**
     * @test
     * @depends create_customer_field
     * @param string $id
     * @return \stdClass
     */
    public function get_created_customer_field_options(string $id) :\stdClass
    {
        try {
            $fieldService = new FieldService();

            $ret = $fieldService->getCustomFieldOption($id);

            return $ret;
        } catch (JiraException $e) {
            $this->fail('get_created_customer_field_options Failed : '.$e->getMessage());
        }
    }
}
