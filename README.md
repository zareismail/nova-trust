# Nova Trust

Nova Trust is a package that based on [Laratrust](https://laratrust.santigarcor.me); a laravel package, that providing user ACL. 

## Installation

Install the package in a Laravel Nova project via Composer:

```bash
composer require zareismail/nova-trust
```

Publish the `nova-trust` publishable files:

```bash
php artisan vendor:publish --tag="nova-trust"  
```
This command publishing `views`, `config`, `lang` and database `migrations` into the compatible path.
Also, you can publish it separately by the following commands:

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

Then Register the tool by  the `tools` method of the `NovaServiceProvider`:

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

At the end, you should insert `NovaTrust\Concenrs\InteractsWithNovTrust` trait in the users model.

## Configuration

### Configuration File
In your `config/nova-trust.php` file you will find all the package configurations that you can customize 

### Teams Feature 
If you want to use the team's feature; that allows you to attach `roles` and `permissions` to a user depending on a team, you must change the `teams_strict_check` key value to `true` in your `config/nova-trust.php` file.

### Multiple User Resources
In the `config/nova-trust.php` file you will find an `user_resources` array, it contains the information about the multiple user resources and the name of the relationships inside the Role and Permission models. For example:
```'
user_resources' => [
    'users' => 'App\Nova\User',
],
```
### Developer Access
After installation you will saw `403` error; for solving this situation; you can define `isDeveloper` method in `user` model that should return `true` value; that cause the user can access to anything.

### Define New Permission
This package uses the `abilities` and `policies public methods`, for defining permissions.   
So for define new permission, you should follow laravel [Authorization](https://laravel.com/docs/5.8/authorization) docs.

By Default; exists some reserved permission for `superior` access that's names are:
 `view Any`, `view`, `create`, `update`, `delete`, `attach`, `detach`, `forceDelete`, `add`.

that means if attach one of the `superior` permission to a `role` or `user`; the user will have permission to do the action for all models. 
for example;  when attached `create` permission to a user; the user can create `anything`.

Also, there exist some `ownership` permissions that attaching one of them to user cause user just access to own resource. for example, when attached `updateOwn` permission to a user its can just update resources that created.
 
## License

Nova Trust is open-sourced software licensed under the [MIT license](LICENSE.md).
