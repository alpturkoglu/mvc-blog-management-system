<?php

use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function testSlugGeneration(): void
    {
        $title = 'PHP MVC Tutorial';

        $slug = strtolower(
            trim(
                preg_replace(
                    '/[^A-Za-z0-9-]+/',
                    '-',
                    $title
                )
            )
        );

        $this->assertEquals(
            'php-mvc-tutorial',
            $slug
        );
    }

    public function testPostStatusIsValid(): void
    {
        $status = 'published';

        $this->assertTrue(
            in_array(
                $status,
                ['draft', 'published'],
                true
            )
        );
    }
}