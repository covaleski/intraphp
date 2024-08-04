# IntraPHP

Experimental PHP desktop emulation library.

For now, this is a simple library to run local PHP projects like desktop apps using Chromium. Use it for development purposes only and read [Security](#security). Plans are to improve performance and security in the future.

## Installation

Require the library using Composer.

```shell
composer require covaleski/intraphp
```

## Usage

Add an optional bootstrap file named `bootstrap.php` to your project root if you want to setup anything - including environment variables - before running your app.

```php
// bootstrap.php

putenv('APP_DOCROOT=' . __DIR__ . '/public');
putenv('PHP_EXECUTABLE=php8.1');
```

Run the `intraphp` command to start your application.

```php
./vendor/bin/intraphp
```

## Environment

The library uses the following environment variables to setup the application:

| Variable | Description | Default |
| --- | --- | --- |
| APP_BOOTSTRAP | Bootstrap script location. | Project root `boostrap.php`. |
| APP_DOCROOT | Directory containing your `index.php`. | Project root. |
| APP_HOMEPAGE | Web application initial path. | `/` |
| APP_SERVER_HOST | Application host name. | `localhost` |
| APP_SERVER_PORT | Port to serve the application. | `8888` |
| APP_SERVER_PROTOCOL | Protocol to use in URLs. | `http` |
| CHROMIUM_EXECUTABLE | Chromium executable. | `chromium` |
| PHP_EXECUTABLE | PHP executable. | `php` |

## Security

This library is a simple experiment and has critical security weaknesses for now:

- The PHP built-in server is used - it is not suited for production;
- The host - `localhost` - is accessible by any application in your computer;
- No encryption is used and the default protocol is `http:`, not `https:`;
- No INI directives are set;
- Your home is accessible by the application as it is not sandboxed.

There are plans to make it suitable for production by replacing `localhost` by Unix domain sockets, using file permissions and encryption for protection, setting INI directives and other measures.
