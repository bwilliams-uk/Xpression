<?php
return new class extends XpressionBaseTest {

    public function setup($xp)
    {
        $xp->with([
            'vara' => 3,
            'varb' => 9,
            'varc' => 27,
        ]);
    }

    public function testDefault($xp)
    {
        $result = $this->tryExpression($xp,'$varc / $varb + $vara');
        $this->assertEquals(6, $result);
    }

    public function testPercentage($xp)
    {
        $xp->affix('%');
        $result = $this->tryExpression($xp,'%varc / %varb + %vara');
        $this->assertEquals(6, $result);
    }

    public function testPercentageEncapsulated($xp)
    {
        $xp->affix('%', '%');
        $result = $this->tryExpression($xp,'%varc% / %varb% + %vara%');
        $this->assertEquals(6, $result);
    }

    public function testSquares($xp)
    {
        $xp->affix('[', ']');
        $result = $this->tryExpression($xp,'[varc] / [varb] + [vara]');
        $this->assertEquals(6, $result);
    }

    public function testCurly($xp)
    {
        $xp->affix('{', '}');
        $result = $this->tryExpression($xp,'{varc} / {varb} + {vara}');
        $this->assertEquals(6, $result);
    }

    public function testDoubleCurly($xp)
    {
        $xp->affix('{{', '}}');
        $result = $this->tryExpression($xp,'{{varc}} / {{varb}} + {{vara}}');
        $this->assertEquals(6, $result);
    }

    public function testAt($xp)
    {
        $xp->affix('@');
        $result = $this->tryExpression($xp,'@varc / @varb + @vara');
        $this->assertEquals(6, $result);
    }

    public function testHash($xp)
    {
        $xp->affix('#');
        $result = $this->tryExpression($xp,'#varc / #varb + #vara');
        $this->assertEquals(6, $result);
    }
};
