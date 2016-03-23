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
        echo "I'm init\n";
    }

    public function escape($s) { return $s; }

    public function dump($p, $type='info')
    {
        $this->store[] = [$p, $type];
    }
}
