# EventsDispatcher

[![Build Status](https://travis-ci.org/activecollab/eventsdispatcher.svg?branch=master)](https://travis-ci.org/activecollab/eventsdispatcher)

This package offers simple events dispatcher, with listeners. Key concepts:

1. Events are not arbitrary strings, but instances that encapsulate all relevant event data,
1. When you specify a listener, you specify an event class (or interface) that you want to listen to,
1. You can listen to entire classes of events, by specifying general enough event class (or interface).

General listener example:

```php
<?php

namespace MyApp;

use ActiveCollab\EventsDispatcher\EventsDispatcher;
use ActiveCollab\EventsDispatcher\Test\Fixtures\LicenseRenewedEvent\LicenseRenewedEventInterface;

$dispatcher = new EventsDispatcher();
$dispatcher->listen(LicenseRenewedEventInterface::class, function (LicenseRenewedEventInterface $event) {
    print "License {$event->getLicenseKey()} has been renewed\n";
});
```

To specify a global listener, that handles all events, just go highly general with the specification:

```php
<?php

namespace MyApp;

use ActiveCollab\EventsDispatcher\EventsDispatcher;
use ActiveCollab\EventsDispatcher\Events\EventInterface;

$dispatcher = new EventsDispatcher();
$dispatcher->listen(EventInterface::class, function (EventInterface $event) {
    print "Event " . get_class($event) . " handled\n";
});
```

Similar approach can be used to handle a class of events. Instead of using the base `EventInterface`, register listener to a class, or interface that all events of a targeted type extend, or implement.

To trigger an event, call `trigger()` method with event as the first (and only) argument:

```php
<?php

namespace MyApp;

use ActiveCollab\EventsDispatcher\EventsDispatcher;
use ActiveCollab\EventsDispatcher\Test\Fixtures\LicenseRenewedEvent\LicenseRenewedEvent;

$dispatcher = new EventsDispatcher();
$dispatcher->trigger(new LicenseRenewedEvent(
    '123',
    '2016-12-31',
    '2017-12-31',
    699.0
));
```
