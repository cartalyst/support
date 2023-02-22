# Changelog

### v7.0.0 - 2023-02-22

- Updated for Laravel 10.

### v6.0.1 - 2022-04-19

`FIXED`

- PHP 8.1 compat.

### v6.0.0 - 2022-02-14

- Updated for Laravel 9.

### v5.1.2 - 2021-03-01

`REVISED`

- Use `null` for the `afterCommit` property to be inline with Laravel's default value.

### v5.1.1 - 2021-02-12

`FIXED`

- Issue with missing `afterCommit` property on the Events trait.

### v5.1.0 - 2020-12-22

- Add PHP 8 support.

### v5.0.0 - 2020-09-12

- Updated for Laravel 8.

### v4.0.0 - 2020-03-03

- Updated for Laravel 7.

### v3.0.1 - 2019-09-10

`REVISED`

- Dropped deprecated dispatcher method check.

### v3.0.0 - 2019-09-04

- BC Break: PHP 7.2 is the minimum required PHP version
- BC Break: Laravel 6.0 is the minimum supported Laravel version

### v2.0.3 - 2019-03-02

`REVISED`

- Minor tweak on event dispatcher method resolving

### v2.0.2 - 2019-03-02

`FIXED`

- Event dispatching method calling for Laravel 5.8 support

### v2.0.1 - 2017-02-23

`UPDATED`

- use various laravel contracts.

### v2.0.0 - 2017-02-23

`UPDATED`

- use `Illuminate\Contracts\Events\Dispatcher` for events.

### v1.2.0 - 2016-06-21

`ADDED`

- `NamespacedEntityInterface` A contract for namespacing entities.

### v1.1.2 - 2015-06-24

`UPDATED`

- License to 3-clause BSD.
- Some other minor tweaks.

### v1.1.1 - 2015-02-04

`UPDATED`

- Added the ability to set custom messages and custom attributes on the Validator class.

### v1.1.0 - 2015-01-23

`ADDED`

- `Collection` A Collection class, similar to the Laravel Collection but more simpler.
- `Mailer` A Mailer class that implements the `Illuminate\Mail\Mailer` with lots of helper methods.
- `Validator` A Validation class that allows you to define different rules for different scenarios throughout your application.
- `ContainerTrait` Common methods and properties for accessing the Laravel IoC.
- `MailerTrait` Common methods and properties for sending emails.
- `ValidatorTrait` Common methods and properties for doing validation.

### v1.0.1 - 2015-06-24

`UPDATED`

- License to 3-clause BSD.
- Some other minor tweaks.

### v1.0.0 - 2014-08-07

`INIT`

- `EventTrait` Common methods and properties for dispatching events.
- `RepositoryTrait` Common methods and properties for use across repositories.
