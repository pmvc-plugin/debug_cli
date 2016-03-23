<?php
PMVC\Load::plug();
PMVC\addPlugInFolder('../');
class Debug_cliTest extends PHPUnit_Framework_TestCase
{
    private $_plug = 'debug_cli';
    function testPlugin()
    {
        ob_start();
        print_r(PMVC\plug($this->_plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertContains($this->_plug,$output);
    }

    function testError()
    {
        $plug = PMVC\plug($this->_plug);
        \PMVC\plug('debug', ['output'=>$plug]);
        ob_start();
        \PMVC\d('aaa');
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertContains('string(3) "aaa"',$output);
    }
}
