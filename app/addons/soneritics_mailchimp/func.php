<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_soneritics_mailchimp_get_api()
{
    $settings = new SoneriticsMailchimpSettings();

    $api = new SoneriticsMailchimpApi(
        $settings->getApiKey(),
        $settings->getServer()
    );

    $listId = $settings->getListId();

    if (!empty($listId)) {
        $api->setListId($listId);
    }

    return $api;
}

function fn_soneritics_mailchimp_get_lists()
{
    return fn_soneritics_mailchimp_get_api()->getLists();
}

function fn_soneritics_mailchimp_get_active_list_id()
{
    return (new SoneriticsMailchimpSettings())->getListId();
}

function fn_soneritics_mailchimp_add_subscriber(string $email, string $firstname, string $lastname)
{
    if ((new SoneriticsMailchimpSettings())->shouldExportToMailChimp()) {
        db_query(
            'INSERT INTO ?:soneritics_mailchimp_queue(email, firstname, lastname) VALUES(?s, ?s, ?s)',
            $email,
            $firstname,
            $lastname);
    }
}

function fn_soneritics_mailchimp_export_subscriber(string $email, string $firstname, string $lastname)
{
    return fn_soneritics_mailchimp_get_api()->export(
        $email,
        $firstname,
        $lastname);
}