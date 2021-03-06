<?php
namespace PMVC\PlugIn\debug;

use PMVC\TestCase;

class Debug_cliTest extends TestCase
{
    private $_plug = 'debug_cli';
    function testPlugin()
    {
        ob_start();
        print_r(\PMVC\plug($this->_plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->haveString($this->_plug,$output);
    }

    function testDump()
    {
        $plug = \PMVC\plug($this->_plug);
        \PMVC\plug('debug', ['output'=>$plug]);
        ob_start();
        \PMVC\d('aaa');
        $output = ob_get_contents();
        ob_end_clean();
        $this->haveString('aaa',$output);
    }
}
