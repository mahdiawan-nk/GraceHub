<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputHandler
{

    protected $CI;
    protected $inputData;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->helper('url');
        $this->parseInput();
    }

    protected function parseInput()
    {
        $input = $this->getRawInput();

        if ($this->isJson($input)) {
            $this->inputData = json_decode($input);
        } else {
            parse_str($input, $output);
            $this->inputData = (object)$output;
        }

        $this->mypost = (object)$_POST;
        $this->myget = (object)$_GET;
    }


    protected function getRawInput()
    {
        return trim(file_get_contents('php://input'));
    }

    protected function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }



    public function __get($name)
    {
        if ($name === 'mypost') {
            return $this->mypost;
        } elseif ($name === 'myget') {
            return $this->myget;
        }
        if (property_exists($this->inputData, $name)) {
            return $this->inputData->$name;
        }
        return null;
    }
}
