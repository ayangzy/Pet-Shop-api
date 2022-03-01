<?php

namespace Tests;

use Tests\TestStub;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use TestStub;
}
