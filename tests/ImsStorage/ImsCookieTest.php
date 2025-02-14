<?php

namespace Tests\ImsStorage;

use BNSoftware\Lti1p3\ImsStorage\ImsCookie;
use Tests\TestCase;

class ImsCookieTest extends TestCase
{
    public function testItInstantiates()
    {
        $cookie = new ImsCookie();

        $this->assertInstanceOf(ImsCookie::class, $cookie);
    }
}
