<?php

class ApiView
{

    public function response($data, $status)
    {
        header('Content-type: application/json');
        header('HTTP/1.1' . $status . " " . $this->_requestStatus($status));
        json_decode($data);
    }

    private function _requestStatus($code)
    {
        $status = array(
            200 => "OK",
            201 => "Created",
            404 => "Not Found",
            500 => "Internal Server Error"
        );
        return (isset($status[$code])) ? $status[$code] : $status[500];
    }
}

?> 