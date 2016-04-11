<?php

return [
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
