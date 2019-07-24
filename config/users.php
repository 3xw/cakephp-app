<?php
use Cake\Routing\Router;

$config = [
  'Users' => [
    // Table used to manage users
    'table' => 'CakeDC/Users.Users',
    // Controller used to manage users plugin features & actions
    'controller' => 'CakeDC/Users.Users',
    // Password Hasher
    'passwordHasher' => '\Cake\Auth\DefaultPasswordHasher',
    'middlewareQueueLoader' => \CakeDC\Users\Loader\MiddlewareQueueLoader::class,
    // token expiration, 1 hour
    'Token' => ['expiration' => 3600],
    'Email' => [
      // determines if the user should include email
      'required' => true,
      // determines if registration workflow includes email validation
      'validate' => true,
    ],
    'Registration' => [
      // determines if the register is enabled
      'active' => true,
      // determines if the reCaptcha is enabled for registration
      'reCaptcha' => true,
      // allow a logged in user to access the registration form
      'allowLoggedIn' => false,
      //ensure user is active (confirmed email) to reset his password
      'ensureActive' => true,
      // default role name used in registration
      'defaultRole' => 'user',
    ],
    'reCaptcha' => [
      // reCaptcha key goes here
      'key' => null,
      // reCaptcha secret
      'secret' => null,
      // use reCaptcha in registration
      'registration' => false,
      // use reCaptcha in login, valid values are false, true
      'login' => false,
    ],
    'Tos' => [
      // determines if the user should include tos accepted
      'required' => true,
    ],
    'Social' => [
      // enable social login
      'login' => false,
    ],
    'Profile' => [
      // Allow view other users profiles
      'viewOthers' => true,
      'route' => ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'profile'],
    ],
    'Key' => [
      'Session' => [
        // session key to store the social auth data
        'social' => 'Users.social',
        // userId key used in reset password workflow
        'resetPasswordUserId' => 'Users.resetPasswordUserId',
      ],
      // form key to store the social auth data
      'Form' => [
        'social' => 'social'
      ],
      'Data' => [
        // data key to store the users email
        'email' => 'email',
        // data key to store email coming from social networks
        'socialEmail' => 'info.email',
        // data key to check if the remember me option is enabled
        'rememberMe' => 'remember_me',
      ],
    ],
    // Avatar placeholder
    'Avatar' => ['placeholder' => 'CakeDC/Users.avatar_placeholder.png'],
    'RememberMe' => [
      // configure Remember Me component
      'active' => true,
      'checked' => true,
      'Cookie' => [
        'name' => 'remember_me',
        'Config' => [
          'expires' => '1 month',
          'httpOnly' => true,
        ]
      ]
    ],
  ],
  'OneTimePasswordAuthenticator' => [
    'checker' => \CakeDC\Auth\Authentication\DefaultOneTimePasswordAuthenticationChecker::class,
    'verifyAction' => [
      'plugin' => 'CakeDC/Users',
      'controller' => 'Users',
      'action' => 'verify',
      'prefix' => false,
    ],
    'login' => false,
    'issuer' => null,
    // The number of digits the resulting codes will be
    'digits' => 6,
    // The number of seconds a code will be valid
    'period' => 30,
    // The algorithm used
    'algorithm' => 'sha1',
    // QR-code provider (more on this later)
    'qrcodeprovider' => null,
    // Random Number Generator provider (more on this later)
    'rngprovider' => null
  ],
  'U2f' => [
    'enabled' => false,
    'checker' => \CakeDC\Auth\Authentication\DefaultU2fAuthenticationChecker::class,
    'startAction' => [
      'plugin' => 'CakeDC/Users',
      'controller' => 'Users',
      'action' => 'u2f',
      'prefix' => false,
    ]
  ],
  // default configuration used to auto-load the Auth Component, override to change the way Auth works
  'Auth' => [
    'Authentication' => [
      'serviceLoader' => \CakeDC\Users\Loader\AuthenticationServiceLoader::class
    ],
    'AuthenticationComponent' => [
      'load' => true,
      'loginAction' => [
        'plugin' => 'CakeDC/Users',
        'controller' => 'Users',
        'action' => 'login',
        'prefix' => false,
      ],
      'logoutRedirect' => [
        'plugin' => 'CakeDC/Users',
        'controller' => 'Users',
        'action' => 'login',
        'prefix' => false,
      ],
      'loginRedirect' => '/',
      'requireIdentity' => false
    ],
    'Authenticators' => [
      'Session' => [
        'className' => 'Authentication.Session',
        'skipTwoFactorVerify' => true,
        'sessionKey' => 'Auth',
      ],
      'Form' => [
        'className' => 'CakeDC/Auth.Form',
        'urlChecker' => 'Authentication.CakeRouter',
        'loginUrl' => [
          'plugin' => 'CakeDC/Users',
          'controller' => 'Users',
          'action' => 'login',
          'prefix' => false,
        ]
      ],
      'Token' => [
        'className' => 'Authentication.Token',
        'skipTwoFactorVerify' => true,
        'header' => null,
        'queryParam' => 'api_key',
        'tokenPrefix' => null,
      ],
      'Cookie' => [
        'className' => 'CakeDC/Auth.Cookie',
        'skipTwoFactorVerify' => true,
        'rememberMeField' => 'remember_me',
        'cookie' => [
          'expires' => '1 month',
          'httpOnly' => true,
        ],
        'urlChecker' => 'Authentication.CakeRouter',
        'loginUrl' => [
          'plugin' => 'CakeDC/Users',
          'controller' => 'Users',
          'action' => 'login',
          'prefix' => false,
        ]
      ],
      'Social' => [
        'className' => 'CakeDC/Users.Social',
        'skipTwoFactorVerify' => true,
      ],
      'SocialPendingEmail' => [
        'className' => 'CakeDC/Users.SocialPendingEmail',
        'skipTwoFactorVerify' => true,
      ]
    ],
    'Identifiers' => [
      'Password' => [
        'className' => 'Authentication.Password',
        'fields' => [
          'username' => ['username', 'email'],
          'password' => 'password'
        ],
        'resolver' => [
          'className' => 'Authentication.Orm',
          'finder' => 'active'
        ],
      ],
      "Social" => [
        'className' => 'CakeDC/Users.Social',
        'authFinder' => 'active'
      ],
      'Token' => [
        'className' => 'Authentication.Token',
        'tokenField' => 'api_token',
        'resolver' => [
          'className' => 'Authentication.Orm',
          'finder' => 'active'
        ],
      ]
    ],
    "Authorization" => [
      'enable' => true,
      'serviceLoader' => \CakeDC\Users\Loader\AuthorizationServiceLoader::class
    ],
    'AuthorizationMiddleware' => [
      'unauthorizedHandler' => [
        'exceptions' => [
          'MissingIdentityException' => 'Authorization\Exception\MissingIdentityException',
          'ForbiddenException' => 'Authorization\Exception\ForbiddenException',
        ],
        'className' => 'Authorization.CakeRedirect',
        'url' => [
          'plugin' => 'CakeDC/Users',
          'controller' => 'Users',
          'action' => 'login',
        ]
      ]
    ],
    'AuthorizationComponent' => [
      'enabled' => true,
    ],
    'RbacPolicy' => [],
    'PasswordRehash' => [
      'identifiers' => ['Password'],
    ]
  ]
];

return $config;
