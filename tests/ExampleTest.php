<?php

namespace Bytedigital123\ImageUpload\Tests;

use Bytedigital123\ImageUpload\ImageUploadServiceProvider;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ImageUploadServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
