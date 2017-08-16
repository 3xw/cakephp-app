<?
return [
  'Users' => [
    // Table used to manage users
    'table' => 'Users',
    // Controller used to manage users plugin features & actions
    'controller' => 'CakeDC/Users.Users',
    // configure Auth component
    'auth' => true,
    // Password Hasher
    'passwordHasher' => '\Cake\Auth\DefaultPasswordHasher',
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
      'active' => false,
      // determines if the reCaptcha is enabled for registration
      'reCaptcha' => true,
      // allow a logged in user to access the registration form
      'allowLoggedIn' => false,
      //ensure user is active (confirmed email) to reset his password
      'ensureActive' => false,
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
      // enable social login
      'authenticator' => 'CakeDC/Users.Social',
    ],
    'GoogleAuthenticator' => [
      // enable Google Authenticator
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
    'Profile' => [
      // Allow view other users profiles
      'viewOthers' => true,
      'route' => ['controller' => 'Users', 'action' => 'profile','prefix' => 'admin','plugin' => false],
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
    'Avatar' => ['placeholder' => 'admin/avatar.jpg'],
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
  'GoogleAuthenticator' => [
    'verifyAction' => [
      'plugin' => 'CakeDC/Users',
      'controller' => 'Users',
      'action' => 'verify',
      'prefix' => false,
    ],
  ],
  // default configuration used to auto-load the Auth Component, override to change the way Auth works
  'Auth' => [
    'logoutRedirect' => [
      'plugin' => 'CakeDC/Users',
      'controller' => 'Users',
      'action' => 'login',
      'prefix' => false
    ],
    'loginAction' => [
      'plugin' => 'CakeDC/Users',
      'controller' => 'Users',
      'action' => 'login',
      'prefix' => false
    ],
    'loginRedirect' => ['controller' => 'Dashboard', 'action' => 'index', 'prefix'=> 'admin', 'plugin' => false,],
    'authenticate' => [
      'all' => [
        'finder' => 'auth',
      ],
      'CakeDC/Auth.ApiKey',
      'CakeDC/Auth.RememberMe',
      'Form' => [
        'fields' => [
          'username' => 'email'
        ]
      ],
    ],
    'authorize' => [
      'CakeDC/Auth.Superuser',
      'CakeDC/Auth.SimpleRbac',
    ],
  ],
];
