<?php


use Server\Example\phpExample\MyError;
use Server\Example\phpExample\MyFirstServiceIf;

class Handler implements MyFirstServiceIf {

    public function log($filename) {
        $time = date('Y-m-d H:m:s');
        file_put_contents(__DIR__."/".$filename, $time."n", FILE_APPEND);
        error_log("Written " . $time . " to " . $filename);
    }

    public function multiply($number1, $number2) {
        error_log("multiply " . $number1 . " by " . $number2);
        return $number1 * $number2;
    }

    /**
     * @param string $filename
     * @return int
     * @throws MyError
     */
    public function get_log_size($filename) {

        $filesize = filesize(__DIR__."/".$filename);

        if ($filesize === false)
            {
                $e = new MyError();
                $e->error_code = 1;
                $e->error_description = "Can't get size information for file " . $filename;
                throw $e;
            }
        error_log("size of log file " . $filename . " is " . $filesize . "B");
        return $filesize;
    } 

};
