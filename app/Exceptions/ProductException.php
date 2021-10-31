<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ProductException extends Exception
{
    public function __construct($message, $code = 0, private $data) {
        parent::__construct($message, $code);
    }

    public function report()
    {
        Log::alert($this->getMessage(), ['data' => $this->data]);
    }
}
