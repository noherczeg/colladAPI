<?php namespace ColladAPI\Core\Mail;

use ColladAPI\Core\Szemely\Szemely;
use Illuminate\Support\Facades\Mail;

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