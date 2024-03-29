<?php
namespace phpExample;

/**
 * Autogenerated by Thrift Compiler (0.12.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;

class MyFirstService_multiply_args
{
    static public $isValidate = false;

    static public $_TSPEC = array(
        1 => array(
            'var' => 'number1',
            'isRequired' => false,
            'type' => TType::I32,
        ),
        2 => array(
            'var' => 'number2',
            'isRequired' => false,
            'type' => TType::I32,
        ),
    );

    /**
     * @var int
     */
    public $number1 = null;
    /**
     * @var int
     */
    public $number2 = null;

    public function __construct($vals = null)
    {
        if (is_array($vals)) {
            if (isset($vals['number1'])) {
                $this->number1 = $vals['number1'];
            }
            if (isset($vals['number2'])) {
                $this->number2 = $vals['number2'];
            }
        }
    }

    public function getName()
    {
        return 'MyFirstService_multiply_args';
    }


    public function read($input)
    {
        $xfer = 0;
        $fname = null;
        $ftype = 0;
        $fid = 0;
        $xfer += $input->readStructBegin($fname);
        while (true) {
            $xfer += $input->readFieldBegin($fname, $ftype, $fid);
            if ($ftype == TType::STOP) {
                break;
            }
            switch ($fid) {
                case 1:
                    if ($ftype == TType::I32) {
                        $xfer += $input->readI32($this->number1);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 2:
                    if ($ftype == TType::I32) {
                        $xfer += $input->readI32($this->number2);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                default:
                    $xfer += $input->skip($ftype);
                    break;
            }
            $xfer += $input->readFieldEnd();
        }
        $xfer += $input->readStructEnd();
        return $xfer;
    }

    public function write($output)
    {
        $xfer = 0;
        $xfer += $output->writeStructBegin('MyFirstService_multiply_args');
        if ($this->number1 !== null) {
            $xfer += $output->writeFieldBegin('number1', TType::I32, 1);
            $xfer += $output->writeI32($this->number1);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->number2 !== null) {
            $xfer += $output->writeFieldBegin('number2', TType::I32, 2);
            $xfer += $output->writeI32($this->number2);
            $xfer += $output->writeFieldEnd();
        }
        $xfer += $output->writeFieldStop();
        $xfer += $output->writeStructEnd();
        return $xfer;
    }
}
