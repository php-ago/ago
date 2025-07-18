# Release Notes

## v4.1.0 (2025-06-18)
💻 Added Container Engines (like Podman and Docker) support to the project

## v4.0.1 (2025-01-18)
- 🐛 Bug fix with incorrect days in a year

## v4.0.0 (2024-12-11)
> 🚀 [Upgrade Guide from v3 to v4](https://php-ago.github.io/4.x/upgrade)
- Breaking changes
    - ⚠️ Drop support for PHP `7.1`, `7.2`, `7.3`, `7.4`, `8.0`
    - ⚠️ The `Option` class is now an enum type
    - ⚠️ Remove second parameter from `Serhii\TimeAgo\Lang::set()` method, which was `$overwrites`. Now, overwrites are defined through the configuration
- Improvements
    - ♻️ Codebase refactoring and cleanup
    - 🧑‍💻 Remove `InvalidDateFormatException` exception that was thrown from `TimeAgo::trans()` in the version `3`
    - ✨ Added support for PHP 8.4
    - ✨ Added new option `Option::RESET_CONF` to reset the configuration to default values
    - 🧑‍💻 Added `configure` and `reconfigure` methods to the `TimeAgo` class, you can read about them in the [documentation](https://php-ago.github.io/v4/configurations#configuration-options)
    - 🧑‍💻 Improve time calculation including leap years
    - 🇨🇳 Add Chinese Simplified language support

## [Release Notes 3.x](.github/CHANGELOG_3x.md)
## [Release Notes 2.x](.github/CHANGELOG_2x.md)
## [Meaning of Emojis in Changelog](.github/EMOJIS.md)