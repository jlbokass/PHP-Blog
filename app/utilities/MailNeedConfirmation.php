<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 24/01/2019
 * Time: 15:55
 */

namespace App;

use MailgunMailgun;

class MailNeedConfirmation
{
    public static function send($to, $subject, $text, $html)
    {
        # Instantiate the client.
        $mgClient = new Mailgun(Config::MAILGUN_API_KEY);
        $domain = Config::MAILGUN_DOMAIN;
        # Make the call to the client.
        $result = $mgClient->sendMessage($domain, array(
            'from'    => 'Excited UsersManager <mailgun@YOUR_DOMAIN_NAME>',
            'to'      => $to,
            'subject' => $subject,
            'text'    => $text,
            'html'    => $html
        ));
    }
}
