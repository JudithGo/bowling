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

    /**
     * @test 
     */
    public function gameMustReturn103()
    {
        $this->assertEquals(103, $this->sut->convert('81x9/5-2762-1246/2/8'));
    }

    /**
     * @test 
     */
    public function gameMustReturn0()
    {
        $this->assertEquals(0, $this->sut->convert('00000000000000000000'));
    }

    /**
     * @test 
     */
    public function gameMustReturn60()
    {
        $this->assertEquals(60, $this->sut->convert('33333333333333333333'));
    }

    /**
     * @test 
     */
    public function gameMustReturn152()
    {
        $this->assertEquals(152, $this->sut->convert('x6-4/x--22-/xxx8-'));
    }


}
