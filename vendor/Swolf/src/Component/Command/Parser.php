<?php

namespace Swolf\Component\Command;


class  Parser
{

    private $params;
    private $longoptions;

    const PROVIDE_OPTIONAL = 1;
    const PROVIDE_MUST = 2;
    const PROVIDE_NOVALUE = 3;


    public function &String($name, $provide, $default = '', $description = '')
    {
        return $this->Variable('string', $name, $provide, $default, $description);
    }


    public function &Int($name, $provide, $default = 0, $description = '')
    {
        return $this->Variable('int', $name, $provide, $default, $description);
    }

    public function &Float($name, $provide, $default = 0.0, $description = '')
    {
        return $this->Variable('float', $name, $provide, $default, $description);
    }

    public function &Bool($name, $provide, $default = false, $description = '')
    {
        return $this->Variable('bool', $name, $provide, $default, $description);
    }


    public function Parse()
    {
        $arguments = getopt('', $this->longoptions);
        foreach ($this->params as $k => $v) {
            if (!isset($arguments[$k])) {
                if ($v['provide'] == self::PROVIDE_MUST) {
                    echo "command arguments parse error: argument '$k' needed but not defined.\n";
                    $this->Usage();
                    exit();
                }
                $arguments[$k] = $v['default'];
            }
            switch ($v['type']) {
                case 'int':
                    $value = intval($arguments[$k]);
                    break;
                case 'float':
                    $value = floatval($arguments[$k]);
                    break;
                case 'bool':
                    $value = boolval($arguments[$k]);
                    break;
                default://string
                    $value = strval($arguments[$k]);
            }
            $this->$k = $value;
        }

    }


    protected function &Variable($type, $name, $provide, $default, $description)
    {
        $this->params[$name] = [
            'type' => $type,
            'default' => $default,
            'description' => $description,
            'provide' => $provide,
        ];
        switch ($provide) {
            case self::PROVIDE_MUST:
                $label = $name . ':';
                break;
            case self::PROVIDE_OPTIONAL:
                $label = $name . '::';
                break;
            default:
                $label = $name;
        }
        $this->longoptions[] = $label;
        $this->$name = $default;
        return $this->$name;
    }


    public function Usage()
    {
        foreach ($this->params as $k => $v) {
            echo '--' . $k . "\t" . $v['description'] . "\n";
        }
        exit();
    }
}
