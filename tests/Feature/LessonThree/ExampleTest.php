<?php

namespace Tests\Unit\LessonThree;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    public function testMocking()
    {
       $mock = \Mockery::mock();

       $mock->shouldReceive('foo')
            ->with('bar')
            ->andReturn('baz');

        $this->assertEquals('baz', $mock->foo('bar'));

        $mock->shouldReceive('qux')
            ->andReturnNull();

        $this->assertNull($mock->qux());
    }

    public function testSpying(){
        //secretly track behavior
        $spy = \Mockery::spy();

        $this->assertNull($spy->qux());

        $spy->shouldHaveReceived('qux')->once();

    }
}
