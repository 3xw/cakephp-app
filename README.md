# 3xw CakePHP Application Skeleton

A skeleton for creating applications with [CakePHP](https://cakephp.org) 3.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. run following:

```bash
composer create-project --prefer-dist 3xw/cakephp-app myapp
```
## DB

1. configure your app.php with db settings
2. run following:

```bash
bin/cake migrations migrate
```
	
this create all needed tables

## Add your first user
Add a user using plugin Users like so:

	bin/cake Users addSuperuser


