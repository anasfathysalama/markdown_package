<?php

namespace Anas\Markdown\Tests\Feature;

use Anas\Markdown\MarkdownFileParser;
use Carbon\Carbon;
use Anas\Markdown\Tests\TestCase;

class MarkdownFileParserTest extends TestCase
{

    /** @test */
    public function the_head_and_body_split_correctly()
    {

        $markdownFileParser = new MarkdownFileParser( __DIR__ . '/../blog/blog_test.md' );

        $data = $markdownFileParser->getRawData();

        $this->assertStringContainsString("title: blog title" , $data[1]);
        $this->assertStringContainsString('description: blog description' , $data[1]);
        $this->assertStringContainsString('Blog body here' , $data[2]);
    }

    /** @test */
    public function string_also_can_be_parsed()
    {
        $markdownFileParser = new MarkdownFileParser( "---\ntitle: blog title\n---\nBlog body here" );

        $data = $markdownFileParser->getRawData();
        $this->assertStringContainsString("title: blog title" , $data[1]);
        $this->assertStringContainsString('Blog body here' , $data[2]);
    }

    /** @test */
    public function the_head_fields_has_separated()
    {
        $markdownFileParser = new MarkdownFileParser( __DIR__ . '/../blog/blog_test.md' );

        $data = $markdownFileParser->getFileData();

        $this->assertEquals('blog title' , $data['title']);
        $this->assertEquals('blog description' , $data['description']);
    }

    /** @test */
    public function the_body_of_file_separated()
    {
        $markdownFileParser = new MarkdownFileParser( __DIR__ . '/../blog/blog_test.md' );

        $data = $markdownFileParser->getFileData();

        $this->assertEquals("# Heading\n\nBlog body here" , $data['body']);
    }

    /** @test */
    public function the_date_field_is_parsed()
    {
        $markdownFileParser = new MarkdownFileParser("---\ndate: May 16, 1996\n---\n");

        $data = $markdownFileParser->getFileData();

        $this->assertInstanceOf(Carbon::class , $data['date']);
        $this->assertEquals('16-05-1996' , $data['date']->format('d-m-Y'));
    }

    /** @test */
    public function the_extra_field_has_been_parsed()
    {
        $markdownFileParser = new MarkdownFileParser("---\nauthor: John Doe\n---\n");

        $data = $markdownFileParser->getFileData();

        $this->assertEquals(json_encode(['author' => 'John Doe']) , $data['extra']);
    }

    /** @test */
    public function an_additional_fields_has_been_parsed()
    {
        $markdownFileParser = new MarkdownFileParser("---\nauthor: John Doe\nimage: url/image.jpg\n---\n");

        $data = $markdownFileParser->getFileData();

        $this->assertEquals(json_encode(['author' => 'John Doe' , 'image'=>'url/image.jpg']) , $data['extra']);
    }
}