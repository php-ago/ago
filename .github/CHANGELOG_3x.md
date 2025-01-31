# Release Notes 3.x

[Documentation for version 3.x](https://php-ago.github.io/3.x/)

## v3.2.6 (2024-11-01)
- Moved repo to a new organization `php-ago/ago`
- Update `composer.json` file

## v3.2.5 (2024-09-08)
- Formatted code with Pint
- Update `README.md` file
- Update composer packages

## v3.2.4 (2024-04-14)
- Modified `LICENSE` file
- Updated composer packages

## v3.2.3 (2024-03-28)
- Added more information to `README.md` file
- Update `nestbot/carbon` package from `^3.0` to `^3.2.1`

## v3.2.2 (2024-03-09)
- Formatted `CHANGELOG.md` file
- Small code refactoring
- Added a new badge to a `README.md` file
- Moved scripts from `Makefile` to `composer.json`
- Removed slashes before each PHP native function

## v3.2.1 (2024-02-16)
- Added a "License" section to `README.md` file
- Added more tests
- Refactored tests

## v3.2.0 (2024-02-15)
- Added support for the German language

## v3.1.0 (2024-02-11)
- Updated `nestbot/carbon` package from `^2.2` to `^3.0`
- Updated `phpstan/phpstan` package from `0.12.x-dev` to `^1.10.57`
- Changed `sandfoxme/private-access` to `arokettu/private-access` package because of the deprecation of the first one

## v3.0.6 (2024-01-22)
- Removed badge from readme.md file
- Added description to each case in `Option` enum

## v3.0.5 (2023-11-14)
- Added support for PHP 8.3

## v3.0.4 (2023-09-06)
- Added support for PHP 8.2
- Connected Pint package to the project

## v3.0.3 (2022-10-09)
- Code refactoring. Making everything look nicer;

## v3.0.2 (2022-01-28)
- Removed comment in code examples in `CONTRIBUTE.md` file
- Typo in `README.md` file

## v3.0.1 (2022-01-28)
- Removed budge from `README.md` file that shows stable release
- Added `Option::JUST_NOW` option that print `Just now` if time is within 1 minute
- Added throwing `InvalidOptionsException` when you pass `JUST_NOW` and `ONLINE` options at the same time

## v3.0.0 (2022-01-27)
- Added banner image to a `README.md` file
- Removed option UPPER that convert number to uppercase. Because I don't want this package to depend on mb string extension