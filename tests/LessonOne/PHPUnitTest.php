<?php

use PHPUnit\Framework\TestCase;

class  PHPUnitTest extends TestCase{

    public function testAssertions(){

        $this->assertTrue(true);
        $this->assertFalse(false);
        $this->assertNull(null);
        $this->assertNotNull(null);

    }

}
