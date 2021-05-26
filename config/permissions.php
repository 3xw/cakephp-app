<?php
return [

  'CakeDC/Auth.permissions' => [

    /* ALL BYPASSES
    ***************************/

    [ // HOOKS
      'prefix' => 'Api',
      'plugin' => false,
      'controller' => 'Hooks',
      'action' => '*',
      'bypassAuth' => true,
    ],

    [ // SEARCH
      'prefix' => 'Api',
      'plugin' => false,
      'controller' => 'Search',
      'action' => '*',
      'bypassAuth' => true,
    ],

    [ // all the front
      'prefix' => false,
      'plugin' => false,
      'controller' => '*',
      'action' => '*',
      'bypassAuth' => true,
    ],

    [ // debug kit
      'prefix' => false,
      'plugin' => 'DebugKit',
      'controller' => '*',
      'action' => '*',
      'bypassAuth' => true,
    ],

    [ // resize fct
      'prefix' => false,
      'plugin' => 'Trois/Attachment',
      'controller' => 'Resize',
      'action' => '*',
      'bypassAuth' => true,
    ],

    [ // pages front
      'prefix' => false,
      'plugin' => 'Trois/Pages',
      'controller' => '*',
      'action' => '*',
      'bypassAuth' => true,
    ],

    [ // register / login processes
      'prefix' => 'Admin',
      'plugin' => false,
      'controller' => 'Users',
      'action' => [
        // LoginTrait
        //'socialLogin',
        'login',
        'logout',
        /*
        'socialEmail',
        'verify',
        // RegisterTrait
        'register',
        'validateEmail',
        // PasswordManagementTrait used in RegisterTrait
        'changePassword',
        'resetPassword',
        'requestResetPassword',
        // UserValidationTrait used in PasswordManagementTrait
        'resendTokenValidation',
        'linkSocial',
        //U2F actions
        'u2f',
        'u2fRegister',
        'u2fRegisterFinish',
        'u2fAuthenticate',
        'u2fAuthenticateFinish',
        */
      ],
      'bypassAuth' => true,
    ],
    /*
    [
      'prefix' => false,
      'plugin' => 'CakeDC/Users',
      'controller' => 'SocialAccounts',
      'action' => [
        'validateAccount',
        'resendValidation',
      ],
      'bypassAuth' => true,
    ],
    */
    /* AUTH AREA - *
    ***************************/

    [ // * - ROLE ADMIN
      'role' => 'admin',
      'prefix' => '*',
      'extension' => '*',
      'plugin' => '*',
      'controller' => '*',
      'action' => '*',
    ],

    /* AUTH AREA - ADMIN
    ***************************/

    [ // USER
      'role' => '*',
      'prefix' => 'Admin',
      'plugin' => false,
      'controller' => 'Drive',
      'action' => ['index','download'],
    ],

    [ // USER
      'role' => ['admin'],
      'prefix' => 'Admin',
      'plugin' => false,
      'controller' => 'Users',
      'action' => ['profile', 'editByUser','changePassword'],
    ],

    /* AUTH AREA - TROIS ATTACHMENT
    ***************************/

    [ // USER
      'role' => '*',
      'prefix' => false,
      'plugin' => 'Trois/Attachment',
      'controller' => 'Download',
      'action' => ['file'],
    ],

    /* AUTH AREA - CAKEDC USERS
    ***************************/

    [ // USER
      'role' => '*',
      'plugin' => 'CakeDC/Users',
      'controller' => 'Users',
      'action' => ['profile', 'logout', 'linkSocial', 'callbackLinkSocial'],
    ],
    [ // USER
      'role' => '*',
      'plugin' => 'CakeDC/Users',
      'controller' => 'Users',
      'action' => 'resetOneTimePasswordAuthenticator',
      'allowed' => function (array $user, $role, \Cake\Http\ServerRequest $request) {
        $userId = \Cake\Utility\Hash::get($request->getAttribute('params'), 'pass.0');
        if (!empty($userId) && !empty($user)) {
          return $userId === $user['id'];
        }

        return false;
      }
    ],
  ]
];
