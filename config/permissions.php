<?php
return [

  'CakeDC/Auth.permissions' => [

    /* ALL BYPASSES
    ***************************/

    [ // CMS TO REMOVE !!!!
      'prefix' => 'Api',
      'plugin' => 'Trois/Cms',
      'controller' => '*',
      'action' => '*',
      'bypassAuth' => true,
    ],
    [ // CMS
      'prefix' => false,
      'plugin' => 'Trois/Cms',
      'controller' => '*',
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
        'socialLogin',
        'login',
        'logout',
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
      ],
      'bypassAuth' => true,
    ],
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


    //admin role allowed to all the things
    [
      'role' => 'admin',
      'prefix' => '*',
      'extension' => '*',
      'plugin' => '*',
      'controller' => '*',
      'action' => '*',
    ],
    //specific actions allowed for the all roles in Users plugin
    [
      'role' => '*',
      'plugin' => 'CakeDC/Users',
      'controller' => 'Users',
      'action' => ['profile', 'logout', 'linkSocial', 'callbackLinkSocial'],
    ],
    [
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
    //all roles allowed to Pages/display
    [
      'role' => '*',
      'controller' => 'Pages',
      'action' => 'display',
      'plugin' => null
    ],

  ]
];
