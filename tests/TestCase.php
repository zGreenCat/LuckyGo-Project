<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;
abstract class TestCase extends BaseTestCase
{
    use InteractsWithAuthentication;
}
