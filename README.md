# IntraPHP

Experimental PHP desktop emulation library.

For now, this is a simple library that runs local PHP projects like desktop apps. It uses Chromium and aims to produce results similar to what Electron does with JavaScript.

Read [Security](#security) and use it for development purposes only. Plans are to improve performance and security in the future.

## Installation

Require the library using Composer.

```shell
composer require covaleski/intraphp
```

## Usage

### Check requirements

You must have Chromium and PHP installed in your system. Check platform requirements using:

```shell
./vendor/bin/intraphp-reqs
```

If something is flagged as "not found", install it, add a installed package to your PATH or change the library executable using [environment variables](#environment).

### Simplest setup

Just add your `index.php` file to your project root directory and run the command:

```shell
./vendor/bin/intraphp
```

See below if you want to set a different public directory and other parameters.

### Custom setups

You can set a custom public directory and [other settings](#environment) using a bootstrap file.

Create a file named `boostrap.php` in your project root directory and add the code you want to run before starting your application.

```php
// bootstrap.php
putenv('APP_DOCROOT=' . __DIR__ . '/public');
putenv('PHP_EXECUTABLE=php8.1');
```

The example above sets the folder `public` as the public directory and tells the library to use `php8.1` to setup the server.

Run the `intraphp` command to start your application.

```shell
./vendor/bin/intraphp
```

### Test configuration

To see the result of your configuration without running your application, use:

```shell
./vendor/bin/intraphp-vars
```

## Environment

The library uses the following environment variables to setup the application:

| Variable | Description | Default value |
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

- PHP's built-in server is used - [it is not suited for production](https://www.php.net/manual/en/features.commandline.webserver.php);
- The host `localhost` is accessible by any application in your computer;
- No encryption is used and the default protocol is `http:`, not `https:`;
- No additional INI directives are set;
- No additional Chromium flags are set;
- Your home is accessible by the application as it is not sandboxed.

There are plans to make it suitable for production by replacing `localhost` by Unix domain sockets, using file permissions and encryption for protection, setting INI directives and other measures.
