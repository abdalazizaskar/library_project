<?php

return [

    'compiled' => env('VIEW_COMPILED_PATH', realpath(storage_path('framework/views'))),

    'paths' => [
        realpath(resource_path('views')),
    ],

];
