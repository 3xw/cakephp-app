# CakePHP Application Skeleton

## Installation
PHP

```bash
composer create-project --prefer-dist 3xw/cakephp-app myapp
```

Modify webpack.env and run

```bash
npm i && npm run build
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Crate a user & token

#### user

```bash
bin/cake users add_superadmin -e email@email.com -p password
```

#### token

```bash
bin/cake tu_token superadmin
```
