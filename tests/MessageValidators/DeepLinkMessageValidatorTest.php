<?php

namespace Tests\MessageValidators;

use BNSoftware\Lti1p3\MessageValidators\DeepLinkMessageValidator;
use Tests\TestCase;

class DeepLinkMessageValidatorTest extends TestCase
{
    public function testItInstantiates()
    {
        $validator = new DeepLinkMessageValidator([]);

        $this->assertInstanceOf(DeepLinkMessageValidator::class, $validator);
    }
}
