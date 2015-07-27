<?php

require_once '../User.php';
require_once '../Helper/Emailer.php';



class MailerCron {

    static function perform() {
        $db = new Database();
        $rows = $db->executeQuery("SELECT * FROM MailQueue WHERE sent = 0");

        if (is_array($rows) && count($rows) > 0) {
            foreach($rows as $data) {
                $result = Emailer::send([$data['senderEmail'] => $data['senderName']], [$data['receiverEmail']], $data['subject'], $data['body']);
                if ($result) {
                    $params = [
                        'id' => $data['id'],
                        'sent' => 1,
                        'now' => date('Y-m-d H:i:s')
                    ];
                    $r = $db->executeUpdate("UPDATE MailQueue SET sentAt=:now, sent=:sent WHERE id = :id", $params);
                    if ($r) {
                        print "[{$data['subject']}] Email sent to: " . $data['receiverEmail'] . PHP_EOL;
                    } else {
                        print "[{$data['subject']}] Failed to send email for: " . $data['receiverEmail'] . PHP_EOL;
                    }
                }
            }
        }
    }
}


# run: HTTP_HOST="{domain.tld}" php email.php
MailerCron::perform();
