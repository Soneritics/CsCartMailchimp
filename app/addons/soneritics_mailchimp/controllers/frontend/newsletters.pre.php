<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $mode == 'add_subscriber') {
    if (!empty($_REQUEST['subscribe_email']) && fn_validate_email($_REQUEST['subscribe_email']) != false) {
        fn_soneritics_mailchimp_add_subscriber(
            $_REQUEST['subscribe_email'],
            '',
            ''
        );
    }
}
