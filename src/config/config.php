<?php

return [
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
