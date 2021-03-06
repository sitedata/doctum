<?php

namespace Doctum\Tests\Reflection;

use Doctum\Console\Application;
use PHPUnit\Framework\TestCase;
use Doctum\Reflection\ClassReflection;

class ClassReflectionTest extends TestCase
{
    public function testIsPhpClass(): void
    {
        // an internal class
        $class = new ClassReflection('stdClass', 1);
        $this->assertTrue($class->isPhpClass());

        // an internal class uppercased
        $class = new ClassReflection('STDCLASS', 1);
        $this->assertTrue($class->isPhpClass());

        // a class that does not exist
        $class = new ClassReflection('FooBarDoesNotExistAsAClass', 1);
        $this->assertFalse($class->isPhpClass());

        // a class that is already loaded
        $class = new ClassReflection(ClassReflectionTest::class, 1);
        $this->assertFalse($class->isPhpClass());

        // a class that exists but is not already loaded
        $class = new ClassReflection(Application::class, 1);
        $this->assertFalse($class->isPhpClass());
    }
}
