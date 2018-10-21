<?php

return [
    'title' => 'Users',
    'single' => 'user',
    'model' => 'App/User',
    'colums' => [
      'id',
      'email'
    ],
    'edit_fields' =>[
            'email' => [
                'type' => 'text',
            ]
    ],



];


/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.09.2018
 * Time: 14:49
 */