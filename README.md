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

$config =  [
    'default'=>'smir',


    'providers'=>[
        'smsir'=>[
            'adapter'=> \mhndev\message\providers\smsir\adapters\SoapAdapter::class,
            'address'=>'http://n.sms.ir/ws/SendReceive.asmx?wsdl',

            'meta'=>[
                'baseLine'=>'yourBaseLine',
            ],

            'credentials'=>[
                'username'=>'yourUserName',
                'password'=>'yourPassword'
            ]
        ],


        'magfa'=>[
            'address'=>'http://sms.magfa.com/magfaHttpService',
            'adapter'=> \mhndev\message\providers\smsir\adapters\RestAdapter::class,

            'meta'=>[
                'baseLine'=> '3000565758',
                'lines'=>[
                    '3000565758'
                ]
            ],

            'credentials'=>[
                'domain'=>'magfa',
                'username'=> 'mabna_00068',
                'password'=> '7#2@SmgqirDGIR4c',
                'panel_password'=>'a3eilm2s2y20#',
            ],

        ]
    ]



];


$client = new \mhndev\message\Client($config);

$client->send('09395410440', 'salam');
```

consider that for creating client object you should pass an configuration array as above.
you can store your configuration file in your application and pass it to client object.

###Providers

each adapter is related to a specific message service.
you can have multiple service providers and specify default service in you config file.

if you want to use specific service you can pass the adapter object in client object but it's optional
so if you don't pass adapter object as an argument for client constructor it would use default adapter.

even you can create your own provider class and extend the configuration file for your class.

for now this package support following sms senders :<br />
[sms.ir](http://www.sms.ir/)<br />
[magfa](https://messaging.magfa.com/ui/)<br />

#Adapters
each provider can have multiple adapter .
for example you can connect to magfa and send sms by soap adapter or rest adapter or even json rpc call just if you have received the permission from magfa.
