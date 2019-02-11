<?php

class BowlingTest extends \PHPUnit\Framework\TestCase
{
    protected $sut;

    protected function setUp(): void
    {
        $this->sut = new Bowling();
    }
    
      /**
     * @test 
     */
    public function allXMustReturn300()
    {
        $this->assertEquals(300, $this->sut->convert('xxxxxxxxxxxx'));
    }

    /**
     * @test 
     */
    public function MissMustReturn90()
    {
        $this->assertEquals(90, $this->sut->convert('9-9-9-9-9-9-9-9-9-9-'));
    }

    /**
     * @test 
     */
    public function spareMustReturn150()
    {
        $this->assertEquals(150, $this->sut->convert('5/5/5/5/5/5/5/5/5/5/5'));
    }
}
