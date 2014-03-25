<?php //lesson/tests/PracticeTest.php

class PracticeTest extends PHPUnit_Framework_TestCase
{
    public function testHelloWorld()
    {
        $greeting = 'Hello, World.';
        $this->assertTrue($greeting === 'Hello, World.');
    }

    public function testLaravelDevsIncludesDayle()
    {
        $names = array('Taylor', 'Shawn', 'Dayle');
        $this->assertContains('Dayle', $names);
    }

}
