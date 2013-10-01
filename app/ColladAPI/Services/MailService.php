<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/27/13
 * Time: 1:29 AM
 */

namespace ColladAPI\Services;


use ColladAPI\Entities\Szemely;

class MailService {

    private $regSubject = 'Üdv nálunk!';

    public function sendRegistered(Szemely $szemely)
    {
        Mail::send('emails.welcome', $szemely, function($message) use ($szemely)
        {
            $message->to($szemely->getEmail(), $szemely->getTeljesNev())->subject($this->regSubject);
        });
    }
}