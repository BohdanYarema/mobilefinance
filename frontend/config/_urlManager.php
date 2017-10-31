<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        'OPTIONS v1/<controller>/<action>/<id:\d+>' => 'v1/<controller>/options',
        'OPTIONS v1/<controller>/<action>' => 'v1/<controller>/options',
    ]
];
