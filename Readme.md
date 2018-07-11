# Neos Dump Server

Bringing the [Symfony Var-Dump Server](https://symfony.com/doc/current/components/var_dumper.html#the-dump-server) to Neos.

This package will give you a dump server, that collects all `\Avency\Neos\var_dump` call outputs, so that it does not interfere with HTTP / API responses.

## Installation

You can install the package via composer:

```bash
composer require --dev avency/neos-vardump
```

The package will register itself automatically. 

## Usage

Start the dump server by calling the flow command:

```bash
./flow dumpserver:start
```

And then you can put `\Avency\Neos\var_dump` calls in your methods. But instead of dumping the output in your current HTTP request, they will be dumped in your terminal.
This is very useful, when you want to dump data from API requests, without having to deal with HTTP errors.

## Credits

- [Beyond Code](https://github.com/beyondcode) for the idea

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
