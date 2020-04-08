# minimalism-service-firebase

**minimalism-service-firebase** is a service for [minimalism](https://github.com/carlonicora/minimalism) to send 
push notifications via firebase.

## Getting Started

To use this library, you need to have an application using minimalism. This library does not work outside this scope.

### Prerequisite

You should have read the [minimalism documentation](https://github.com/carlonicora/minimalism/readme.md) and understand
the concepts of services in the framework.

Encrypter requires either the [cURL](https://www.php.net/manual/en/book.curl.php) extension in order to work.

### Installing

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```
$ composer require carlonicora/minimalism-service-firebase
```

or simply add the requirement in `composer.json`

```json
{
    "require": {
        "carlonicora/minimalism-service-firebase": "~1.0"
    }
}
```

## Deployment

This service requires you to set up two parameters in your `.env` file in order to connect to firebase:

### Required parameters

```dotenv
#your private authorisation key
MINIMALISM_SERVICES_FIREBASE_KEY=  
```

### Optional parameters

```dotenv
#the url used to call the firebase service - default to https://fcm.googleapis.com/fcm/send
MINIMALISM_SERVICES_FIREBASE_URL=
```

## Build With

* [minimalism](https://github.com/carlonicora/minimalism) - minimal modular PHP MVC framework

## Versioning

This project use [Semantiv Versioning](https://semver.org/) for its tags.

## Authors

* **Carlo Nicora** - Initial version - [GitHub](https://github.com/carlonicora) |
[phlow](https://phlow.com/@carlo)

# License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT) - see the
[LICENSE.md](LICENSE.md) file for details 

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)