<?php

return [
    'components' => [
        'commandBus' => [
            'class' => \hiqdev\yii2\tactician\CommandBus::class,
            'locator' => \hiapi\components\InCommandLocator::class,
            'extractor' => \League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor::class,
            'inflector' => \League\Tactician\Handler\MethodNameInflector\HandleInflector::class,
        ],
    ],
];
