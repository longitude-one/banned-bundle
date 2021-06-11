Banned bundle for Symfony
=========================

LongitudeOne\BannedBundle is a very small bundle for Symfony framework. 
It disallows banned users to login on your application. 

Installation
============

Make sure Composer is globally installed, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require longitude-one/banned-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require longitude-one/banned-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    LongitudeOne\BannedBundle\LongitudeOneBannedBundle::class => ['all' => true],
];
```

Configuration
=============
First, your user class should implement the BannedInterface, then add the stub method `isBanned`.

Example
-------

```php
// src/Entity/User.php

namespace App\Entity;

// declare the interface
use LongitudeOne\BannedBundle\Entity\BannedInterface;
use Symfony\Component\Security\Core\User\UserInterface;

// add the interface
class User implements BannedInterface, UserInterface
{
    //Add a private method
    private bool $banned = false;

    //Your getter can be improved to avoid that an admin ban another admin.        
    public function isBanned(): bool
    {
        //In this example admin cannot be banned
        return $this->isBanned() and !in_array('ROLE_ADMIN', $this->getRoles());
    }
    
    //Add a setter if needed
    public function setBanned(bool $banned): self
    {
        $this->banned = $banned;
        
        return $this;
    }
    
    //...    
}
```
Add the security layer:

If you don't use flex, add the UserChecker to your security config:

```yaml
# config/security.yaml
security:
  ...
  firewalls:
    ...
    main:
      ...
      user_checker: LongitudeOne\BannedBundle\Security\UserChecker
```
