<?php

namespace App\Exceptions;

use Exception;

class JsendException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        parent::report($exception);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        //return response(...);
    }
}
