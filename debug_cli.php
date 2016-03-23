<?php
namespace PMVC\PlugIn\debug;
use PMVC as p;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\debug_cli';
p\initPlugin(['debug'=>null], true);

class debug_cli
    extends p\PlugIn
    implements DebugDumpInterface
{
    public function init()
    {
        if (!isset($this['level'])) {
            $this['level'] = 'debug';
        }
    }

    public function escape($s) { return $s; }

    public function getColor($level)
    {
        $levels =  [
            'trace'=>'%y',
            'debug'=>'%g',
            'info'=>'%b',
            'warn'=>'%w',
            'error'=>'%r'
        ];
        if (isset($levels[$level])) {
            return $levels[$level];
        } else {
            return null;
        }
    }

    public function dump($p, $type='debug')
    {
        $cli = p\plug('cli');
        $debug = p\plug('debug');
        if ($debug->getLevel($type) >= $debug->getLevel($this['level'])) {
            if (!is_array($p)) {
                $cli->dump($p, $this->getColor($type));
            } else {
                $cli->tree($p, $this->getColor($type));
            }
        }
    }
}
