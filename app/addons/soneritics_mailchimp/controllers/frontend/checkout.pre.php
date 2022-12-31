<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == "POST"
    && $mode == 'place_order'
    && !empty($_REQUEST['mailing_lists'])) {
    $firstname = \Tygh\Tygh::$app['session']['cart']['user_data']['firstname'];
    $lastname = \Tygh\Tygh::$app['session']['cart']['user_data']['lastname'];
    $email = \Tygh\Tygh::$app['session']['cart']['user_data']['email'];

    fn_soneritics_mailchimp_add_subscriber(
        $email,
        $firstname,
        $lastname
    );
}
