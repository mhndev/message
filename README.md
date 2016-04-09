php message client for sending and receiving messages using rest or soap

sample usage

```php
$client = new \mhndev\message\Client(include "config.php");

$client->send('09395410440', 'salam');
```