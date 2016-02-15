<?php

namespace BenchmarkerBundle\Service;


use BenchmarkerBundle\Email\EmailInterface;

class EmailService
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer = null)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param EmailInterface $email
     */
    public function send(EmailInterface $email)
    {
        $message = $this->composeMessage($email);

        $this->mailer->send($message);
        //todo do something with failed recipients or other stuff, log them
    }

    /**
     * @param EmailInterface $email
     *
     * @return \Swift_Message
     */
    private function composeMessage(EmailInterface $email)
    {
        /** @var $message \Swift_Message */
        $message = $this->mailer->createMessage();
        $message
            ->setTo($email->getReceiver())
            ->setSubject($email->getSubject())
            ->setBody($email->getBody(), 'text/html')
        ;

        return $message;
    }
}
