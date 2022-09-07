<?php

namespace Anas\Markdown;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class MarkdownFileParser
{

    protected $filePath;
    protected $fileData;

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

    protected function extractFileData()
    {
        preg_match(
            '/^\-{3}(.*?)\-{3}(.*)/s',
            $this->getContent(),
            $this->fileData
        );
    }

    protected function explodeHeadDataFromFile()
    {
        $stringFields = explode("\n", trim($this->fileData[1]));
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
        return preg_replace("/\r/", "", trim($this->fileData[2]));
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
            if ($field === "date") {
                $this->fileData[$field] = Carbon::parse($value);
            } elseif ($field === "body") {
                $this->fileData['body'] = MarkdownParser::parse($value);
            }
        }
    }

}