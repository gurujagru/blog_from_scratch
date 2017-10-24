<?php
return
    [
        [
        'Pattern' => '|^login/?$|',
        'Controller' => 'User',
        'Method' => 'login'
        ],
        [
        'Pattern' => '|^logout/?$|',
        'Controller' => 'User',
        'Method' => 'logout'
        ],
        [
        'Pattern' => '|^signup/?$|',
        'Controller' => 'User',
        'Method' => 'signup'
        ],
        [
        'Pattern' => '|^article/view/([0-9]+)?$|',
        'Controller' => 'Article',
        'Method' => 'view'
        ],
        [
        'Pattern' => '|^article/my-articles/?$|',
        'Controller' => 'Article',
        'Method' => 'myArticles'
        ],
        [
        'Pattern' => '|^article/create/?$|',
        'Controller' => 'Article',
        'Method' => 'create'
        ],
        [
        'Pattern' => '|^article/edit/([0-9]+)?$|',
        'Controller' => 'Article',
        'Method' => 'edit'
        ],
        [
        'Pattern' => '|^article/delete/([0-9]+)?$|',
        'Controller' => 'Article',
        'Method' => 'delete'
        ],
        [
        'Pattern' => '|^/*$|',
        'Controller' => 'Article',
        'Method' => 'index'
        ],
        [
        'Pattern' => '|^article/deleteComment/([0-9]+)?$|',
        'Controller' => 'Article',
        'Method' => 'deleteComment'
        ]
    ];