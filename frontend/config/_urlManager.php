<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        // Api
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'accounting',
            'only' => ['index', 'view', 'options', 'create', 'update']
        ],
        // Api
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'category',
            'only' => ['index', 'view', 'options', 'create', 'update']
        ],
    ]
];
