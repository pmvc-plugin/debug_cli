<?php
namespace PMVC\PlugIn\debug;
use PMVC as p;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\debug_cli';
p\initPlugin(['debug'=>null]);

class debug_cli
    extends p\PlugIn
    implements DebugDumpInterface
{
    public function init()
    {
        if (!isset($this['level'])) {
            $this['level'] = p\plug('debug')->getLevel('debug');
        }
    }

    public function escape($s) { return $s; }

    public function dump($p, $type='debug')
    {
        $cli = p\plug('cli');
        $debug = p\plug('debug');
        if ($debug->getLevel($type) >= $this['level']) {
            $cli->dump($p);
        }
    }
}
