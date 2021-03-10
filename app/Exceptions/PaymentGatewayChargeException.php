<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class PaymentGatewayChargeException extends Exception
{

    public function __construct(string $message, array $data )
    {
        $this->data = $data;

        parent::__construct($message);
    }

    /**
     * @return array
     */

    public function getData(): array{
        return $this->data;
    }


    public function render(){

        $data = $this->getData();
        Log::error('Card failed: ', $data);
        $template = 'partials.errors.charge_failed';
        $data = $data['error'];

        return view('errors.generic', compact('template', 'data'));
    }



}
