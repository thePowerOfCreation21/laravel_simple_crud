<?php

namespace App\Exceptions;

use Exception;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class CustomException extends Exception
{
    protected int $httpCode = 500;

    public function __construct(string $message = "", int $code = 0, int $httpCode = 500, ?\Throwable $previous = null)
    {
        $this->httpCode = $httpCode;

        parent::__construct($message, $code, $previous);
    }

    public function render ()
    {
        return response()->json([
            'code' => $this->code,
            'message' => $this->message,
        ],  $this->httpCode);
    }
}
