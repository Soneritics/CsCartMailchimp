<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == "export") {
    $record = db_get_row("SELECT * FROM ?:soneritics_mailchimp_queue");
    $status = "Nothing to export";

    if (!empty($record)) {
        db_query("DELETE FROM ?:soneritics_mailchimp_queue WHERE `id` = ?i", $record['id']);

        fn_soneritics_mailchimp_export_subscriber(
            $record['email'],
            $record['firstname'],
            $record['lastname']
        );

        $status ="Exported {$record['email']}";
    }

    fn_clear_ob();
    die($status);
}
