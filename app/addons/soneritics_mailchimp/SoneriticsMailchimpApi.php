<?php
/*
 * The MIT License
 *
 * Copyright 2023 Jordi Jolink.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
class SoneriticsMailchimpApi
{
    private $api;

    private $listId;

    public function __construct($apiKey, $server = 'us1')
    {
        $this->api = new MailchimpMarketing\ApiClient();

        $this->api->setConfig([
            'apiKey' => $apiKey,
            'server' => $server
        ]);
    }

    public function setListId(string $listId)
    {
        $this->listId = $listId;
    }

    public function getLists()
    {
        try {
            $result = [];

            $lists = $this->api->lists->getAllLists(['lists.id', 'lists.name'], null, 50);

            if (empty($lists) || empty($lists->lists)) {
                return ['' => 'No lists available'];
            }

            foreach ($lists->lists as $list) {
                $result[$list->id] = $list->name;
            }

            return $result;
        } catch (\Throwable $t){
            return ['' => 'No lists available: ' . $t->getMessage()];
        }
    }

    public function export(string $email, string $firstname, string $lastname)
    {
        if (empty($this->listId)) {
            throw new Exception("List ID has not been set, can not export subscriber to Mailchimp.");
        }

        try {
            $this->api->lists->addListMember(
                $this->listId,
                [
                    'email_address' => $email,
                    'status' => 'subscribed',
                    'merge_fields' => [
                        'FNAME' => $firstname,
                        'LNAME' => $lastname
                    ]
                ]
            );
        } catch (Exception $e) {
            // Do nothing
        }
    }
}