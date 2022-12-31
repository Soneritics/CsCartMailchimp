<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($mode == 'update' && $_REQUEST['addon'] == 'soneritics_mailchimp') {
        Tygh\Settings::instance()->updateValue(
            "list_id",
            $_REQUEST['soneritics_mailchimp_list_id'],
            'soneritics_mailchimp');
    }
}
