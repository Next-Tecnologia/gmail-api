<?php

namespace GmailAPI\messages\send;

use GmailAPI\Connection;

final class EmailMessage extends Connection implements IEmailMessage
{
	/**
	 * __construct
	 *
	 * @return void
	 */
    public function __construct()
    {
		parent::__construct();
	}
	/**
	 * enviaEmail
	 *
	 * @param  string[] $from
	 * @param  string[] $to
	 * @param  string $subject
	 * @param  string $body
	 *
	 * @return void
	 */
    public function sendEmail(array $from, array $to, string $subject, string $body): void
    {
		$message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to)
            ->setContentType('text/html')
            ->setCharset('utf-8')
            ->setBody($body);

		$messageBase64 = rtrim(
			strtr(
				base64_encode(
					$message->toString()
				), '+/', '-_'
			), '='
		);

		$messageSend = new \Google_Service_Gmail_Message();
		$messageSend->setRaw($messageBase64);
		$this->service->users_messages->send('me',$messageSend);
	}
}
