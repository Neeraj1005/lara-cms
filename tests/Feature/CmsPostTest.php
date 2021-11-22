<?php

namespace Neeraj1005\Cms\Tests;

use Neeraj1005\Cms\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CmsPostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_list_of_all_posts()
    {
        $this->get('/cms')->assertOk();
    }
}
