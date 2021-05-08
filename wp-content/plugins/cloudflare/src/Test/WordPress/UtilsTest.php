<?php

namespace CF\Test\WordPress;

use CF\WordPress\Utils;

class UtilsTest extends \PHPUnit\Framework\TestCase
{
    public function setup(): void
    {
    }

    public function testEndsWith()
    {
        $this->assertFalse(Utils::endsWith('abcdef', 'ab'));
        $this->assertFalse(Utils::endsWith('abcdef', 'cd'));
        $this->assertTrue(Utils::endsWith('abcdef', 'ef'));
        $this->assertTrue(Utils::endsWith('abcdef', 'abcdef'));
        $this->assertTrue(Utils::endsWith('abcdef', ''));
        $this->assertFalse(Utils::endsWith('', 'abcdef'));
        $this->assertTrue(Utils::endsWith('', ''));
    }

    public function testIsSubdomainOf()
    {
        $this->assertTrue(Utils::isSubdomainOf('sub.domain.com', 'domain.com'));
        $this->assertTrue(Utils::isSubdomainOf('non.sub.domain.com', 'domain.com'));
        $this->assertFalse(Utils::isSubdomainOf('sub.domain.com', 'cooldomain.com'));
        $this->assertFalse(Utils::isSubdomainOf('', 'domain.com'));
        $this->assertFalse(Utils::isSubdomainOf('sub.domain.com', ''));
        $this->assertFalse(Utils::isSubdomainOf('', ''));
        $this->assertFalse(Utils::isSubdomainOf('domain.com', 'domain.com'));
        $this->assertFalse(Utils::isSubdomainOf('testdomain.com', 'domain.com'));
    }

    public function testGetRegistrableDomain()
    {
        $this->assertEquals('domain.com', Utils::getRegistrableDomain('sub.domain.com'));
        $this->assertEquals('domain.co.uk', Utils::getRegistrableDomain('sub.domain.co.uk'));
        $this->assertEquals('sub2.domain.com', Utils::getRegistrableDomain('sub1.sub2.domain.com'));
    }
}
