<?php

namespace Tests\MessageValidators;

use BNSoftware\Lti1p3\MessageValidators\ResourceMessageValidator;
use Tests\TestCase;

class ResourceMessageValidatorTest extends TestCase
{
    public function testItInstantiates()
    {
        $validator = new ResourceMessageValidator([]);

        $this->assertInstanceOf(ResourceMessageValidator::class, $validator);
    }
}
