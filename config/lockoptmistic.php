<?php

/*
|--------------------------------------------------------------------------
| Morrice256 LockOptimistic Config
|--------------------------------------------------------------------------
|
*/

return [ 
    'audit' => [
	'field_name' => 'updated_at', //The collum should exist in object and database table
	'value_type' => 'timestamp', // [timestamp] //The value type of collum to audit
    ],
    'result' => [
       'type' => 'exception' //[exception]
    ]
];