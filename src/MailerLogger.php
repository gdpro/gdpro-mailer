<?php
namespace GdproMailer;

/**
 * Class MailerLogger
 * @package GdproMailer
 */
class MailerLogger
{
    /**
     * @param $templateName
     * @param $recipient
     * @param $smtpName
     * @param $disableDelivery
     * @return string
     */
    public function createLog(
        $templateName,
        $recipient,
        $smtpName,
        $disableDelivery
    ) {
        // Add message template info
        $log = 'Message template: ' . $templateName . '; ';

        // Add recipients infos
        $log .= 'Recipient(s): ';

        $recipients = $recipient;
        if (!is_array($recipient)) {
            $recipients = [$recipient];
        }

        foreach ($recipients as $recipient) {
            $log .= $recipient . ', ';
        }
        $log = substr($log, 0, -2);
        $log .= '; ';

        // Add smtp info
        $log .= 'Smtp name: ' . $smtpName . '; ';

        // Add disable delivery info
        if ($disableDelivery) {
            $log .= 'Delivery is disable.';
        }

        if (!$disableDelivery) {
            $log .= 'Delivery is enable.';
        }

        return $log;
    }
}