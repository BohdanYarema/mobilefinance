<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'site', 'only' => ['index', 'view', 'options', 'create', 'update']],
    ]
];
