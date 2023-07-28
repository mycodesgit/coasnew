<?php

namespace App\Exceptions;

use Exception;

class MyExceptionHandler extends Exception
{
    public function render($request, Throwable $exception)
		{
		    if ($this->isHttpException($exception)) {
		        if ($exception->getStatusCode() == 500) {
		            return redirect('/500');
		        }
		    }
		    return parent::render($request, $exception);
		}
}
