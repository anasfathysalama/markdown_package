<?php

namespace Anas\Markdown\Tests\Feature;

use Anas\Markdown\MarkdownParser;
use Orchestra\Testbench\TestCase;

class MarkdownTest extends TestCase
{

    /** @test */
    public function markdown_is_parsed()
    {
        $this->assertEquals('<h1>Heading</h1>' , MarkdownParser::parse('# Heading'));
    }

}