<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['category'],
        'extraPatterns' => [
            'OPTIONS index' => 'options',
            'GET'           => 'index',
        ],
    ]
];
