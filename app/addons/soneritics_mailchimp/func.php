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