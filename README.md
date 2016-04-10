php message client for sending and receiving messages using rest or soap


###Installation
Add this package to your composer.json and run composer update.
"mhndev/message": "dev-master"

you can also you this composer command :

```
composer require mhndev/message dev-master
```

###Sample usage

```php

$config = [
              'default'=>'smir',


              'providers'=>[
                  'smsir'=>[
                      'adapter'=> \mhndev\message\adapters\smsir::class,
                      'address'=>'http://n.sms.ir/ws/SendReceive.asmx?wsdl',

                      'meta'=>[
                          'baseLine'=>'yourBaseLine',
                      ],

                      'credentials'=>[
                          'username'=>'yourUserName',
                          'password'=>'yourPassword'
                      ]
                  ]
              ]

          ];

$client = new \mhndev\message\Client($config);

$client->send('09395410440', 'salam');
```

consider that for creating client object you should pass an configuration array as above.
you can store your configuration file in your application and pass it to client object.

###Adapters

each adapter is related to a specific message service.
you can have multiple service providers and specify default service in you config file.

if you want to use specific service you can pass the adapter object in client object but it's optional
so if you don't pass adapter object as an argument for client constructor it would use default adapter.

even you can create your own adapter class and extend the configuration file for your class.