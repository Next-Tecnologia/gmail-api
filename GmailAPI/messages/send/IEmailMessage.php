<?php

namespace GmailAPI\messages\send;

interface IEmailMessage
{
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
    public function sendEmail(array $from, array $to, string $subject, string $body): void;
}
