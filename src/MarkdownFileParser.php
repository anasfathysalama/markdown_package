<?php

namespace Anas\Markdown;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MarkdownFileParser
{

    protected $filePath;
    protected $fileData;
    protected $rawData;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->extractFileData();
        $this->explodeHeadDataFromFile();
        $this->processDateFields();
    }

    public function getFileData()
    {
        return $this->fileData;
    }

    public function getRawData()
    {
        return $this->rawData;
    }

    protected function extractFileData()
    {
        preg_match(
            '/^\-{3}(.*?)\-{3}(.*)/s',
            $this->getContent(),
            $this->rawData
        );
    }

    protected function explodeHeadDataFromFile()
    {
        $stringFields = explode("\n", trim($this->rawData[1]));
        foreach ($stringFields as $stringField) {
            preg_match('/(.*)\s?:\s?(.*)/', $stringField, $fieldArray);
            $this->fileData[trim($fieldArray[1])] = trim($fieldArray[2]);
        }
        $this->fileData['body'] = $this->removeCarriageCharacterFromBody();
    }

    /**
     * @return array|string|string[]|null
     */
    private function removeCarriageCharacterFromBody()
    {
        return preg_replace("/\r/", "", trim($this->rawData[2]));
    }

    /**
     * @return string
     */
    private function getContent()
    {
        return File::exists($this->filePath) ? File::get($this->filePath) : $this->filePath;
    }

    protected function processDateFields()
    {
        foreach ($this->fileData as $field => $value) {
            $class = "Anas\\Markdown\\Fields\\" . Str::title($field);
            if (!class_exists($class) && !method_exists($class, 'process')) {
                $class = "Anas\\Markdown\\Fields\\Extra" ;
            }
            $this->fileData = array_merge($this->fileData, $class::process($field, $value , $this->fileData));
        }
    }

}