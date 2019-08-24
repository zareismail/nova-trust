# Nova Trust

Nova Trust is a package that based on [Laratrust](https://laratrust.santigarcor.me); laravel package, that provided for user acl. 

## Installation

Install the package in a Laravel Nova project via Composer:

```bash
composer require zareismail/nova-trust
```

Publish the `nova-trust` publishing files:

```bash
php artisan vendor:publish --tag="nova-trust"  
```

This command publish `views`, `config`, `lang` and database `migrations` into compatible path.
And you can publish it separately by the following commands:

```bash
php artisan vendor:publish --tag="nova-trust-config"  
```

```bash
php artisan vendor:publish --tag="nova-trust-lang"  
```

```bash
php artisan vendor:publish --tag="nova-trust-views"  
```

```bash
php artisan vendor:publish --tag="nova-trust-migrations"  
```

After publishing; You should run the database migration(s):

```bash 
php artisan migrate
```

Then Register the tool with Nova in the `tools()` method of the `NovaServiceProvider`:

```php
// in app/Providers/NovaServiceProvider.php

public function tools()
{
    return [
        // ...
        new \NovaTrust\NovaTrust
    ];
}
```
 
## Configuration

### Configuration File
In your `config/nova-trust.php` file you will find all the package configurations that you can customize 

### Teams Feature 
If you want to use the teams feature that allows you to attach roles and permissions to an user depending on a team, you must change the `teams_strict_check` key value to `true` in your `config/nova-trust.php` file.

### Multiple User Models
In the `config/nova-trust.php` file you will find an `user_resources` array, it contains the information about the multiple user resources and the name of the relationships inside the Role and Permission models. For example:
```'
user_models' => [
    'users' => 'App\Nova\User',
],
```
### Developer Access
After installation you will fall in `403` error; for solve this situation; you can define `isDeveloper` method in `user` model that return's `true` if user can access to any thing.

### Define New Permission
This package find all defined laravel `Gate`, `abilities` and `policies public methods` for permissions. So for new permission you just need follow laravel [Authorization](https://laravel.com/docs/5.8/authorization) docs.

By Default there is reserved permission for `suprior` access named by `viewAny`, `view`, `create`, `update`, `delete`, `attach`, `detach`, `force-delete`, `add`.

that means if attach one of the `suprior` permisison to a `role` or `user`; user will have permission for do action for all models. for example attach `create` permiission to an user; cause user `can create any things`.

In addition there exists some `ownership` permissions that attach one of them to user cause user just access to own resource. for example attach `updateOwn` cause user can just update self created resources.
 
## License

Nova Trust is open-sourced software licensed under the [MIT license](LICENSE.md).
