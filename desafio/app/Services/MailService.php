<?php

namespace App\Services;

use App\Models\Quote;
use App\Mail\SendMailQuote;
use App\Exceptions\SendMailException;

class MailService
{
    /**
     * @param $data
     * @param array $options
     */
    public function sendMailQuote($data, array $options)
    {
        try {

            \Mail::to($options['toMail'])
                ->send(new SendMailQuote($data));

        } catch(\Throwable $e) {
            throw new SendMailException(trans('exception.failSendMail'));
        }
    }
}