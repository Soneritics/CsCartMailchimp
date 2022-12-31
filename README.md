# CsCartMailchimp
Add newsletter subscribers to Mailchimp.

## Queueing
This addon makes use of a queueing mechanism. This not only makes the site faster, it's also way more reliable. There's no direct connection to Mailchimp in the frontend, so even when Mailchimp's API is down, the site has no problems with this at all.

Queueing is mandatory, so it's important to add a cronjob that processes the queue items.

Queue items are processed one by one, so the interval can be as low as possible.

Recommended:

```cron
*/1 * * * * /usr/bin/wget -O /dev/null https://domain.com/index.php?dispatch=soneritics_mailchimp.export >/dev/null 2>&1
```
