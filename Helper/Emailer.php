<?php

include_once '../Config/Config.php';
include_once '../Helper/Database.php';
require_once 'swiftmailer/lib/swift_required.php';


class Emailer {

    static function send(array $from, array $to, $subject, $body, $contentType = 'text/html') {

        $gmail = Config::email();

        $transport = Swift_SmtpTransport::newInstance($gmail['GMAIL']['address'], $gmail['GMAIL']['port'], $gmail['GMAIL']['security'])
            ->setUsername($gmail['GMAIL']['username'])
            ->setPassword($gmail['GMAIL']['password']);

        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body, $contentType);

        return $mailer->send($message);
    }

    static function queue($params) {
        $db = new Database();
        # MailQueue class can be created
        $script =  "INSERT INTO MailQueue SET `type` = :type,
                    senderName = :senderName,
                    senderEmail = :senderEmail,
                    receiverName = :receiverName,
                    receiverEmail = :receiverEmail,
                    cc = :cc,
                    bcc = :bcc,
                    subject = :subject,
                    body = :body";

        return $db->executeUpdate($script, $params);
    }

}