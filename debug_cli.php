<?php
namespace PMVC\PlugIn\debug;
use PMVC as p;
${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\debug_cli';
p\initPlugin(['debug'=>null], true);

class debug_cli
    extends p\PlugIn
    implements DebugDumpInterface
{
    const DEFAULT_LEVEL = 'debug';

    public function init()
    {
        if (!isset($this['level'])) {
            $this['level'] = self::DEFAULT_LEVEL;
        }
    }

    public function escape($s)
    {
        return strtr($s, ["\n"=>'', "\r"=>'']);
    }

    public function getColor($level)
    {
        $levels =  [
            'trace'=>'%y',
            'debug'=>'%g',
            'info'=>'%b',
            'warn'=>'%m',
            'error'=>'%r'
        ];
        if (isset($levels[$level])) {
            return $levels[$level];
        } else {
            return '%c';
        }
    }

    public function dump($p, $type='debug')
    {
        $cli = p\plug('cli');
        $pDebug = p\plug('debug');
        if ($pDebug->isShow(
            $type,
            $this['level'],
            $pDebug->getLevel(self::DEFAULT_LEVEL)
        )) {
            if (!is_array($p)) {
                $cli->dump($p, $this->getColor($type));
            } else {
                $cli->tree($p, $this->getColor($type));
            }
        }
    }
}
