<?php

/*
 * This file is part of the Active Collab EventsDispatcher project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\EventsDispatcher\Test;

use ActiveCollab\EventsDispatcher\Events\EventInterface;
use ActiveCollab\EventsDispatcher\EventsDispatcher;
use ActiveCollab\EventsDispatcher\Test\Fixtures\LicenseRenewedEvent\LicenseRenewedEvent;
use ActiveCollab\EventsDispatcher\Test\Fixtures\LicenseRenewedEvent\LicenseRenewedEventInterface;
use ActiveCollab\EventsDispatcher\Test\Fixtures\SubscriptionCanceledEvent\SubscriptionCanceledEvent;

class EventsDispatcherTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Event class does not exist
     */
    public function testExceptionWhenEventClassDoesNotExist()
    {
        (new EventsDispatcher())->listen('Not a class, for sure');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Event class does not implement EventInterface
     */
    public function testExceptionWhenEventDoesNotImplementEventInterface() 
    {
        (new EventsDispatcher())->listen(self::class);
    }

    public function testListenerIsCalledOnEventTrigger()
    {
        $dispatcher = new EventsDispatcher();

        $listener_is_called = false;

        $dispatcher->listen(
            LicenseRenewedEventInterface::class,
            function () use (&$listener_is_called) {
                $listener_is_called = true;
            }
        );

        $event = new LicenseRenewedEvent('123', '2016-12-31', '2017-12-31', 699.0);

        $dispatcher->trigger($event);

        $this->assertTrue($listener_is_called);
    }

    public function testEventIsPassedAsListenerArgument()
    {
        $dispatcher = new EventsDispatcher();

        $price = false;

        $dispatcher->listen(
            LicenseRenewedEventInterface::class,
            function (LicenseRenewedEventInterface $event) use (&$price) {
                $price = $event->getPrice();
            }
        );

        $event = new LicenseRenewedEvent('123', '2016-12-31', '2017-12-31', 699.0);

        $dispatcher->trigger($event);

        $this->assertSame(699.0, $price);
    }

    public function testListenerIsCalledOnSubclassEventTrigger()
    {
        $dispatcher = new EventsDispatcher();

        $listener_is_called = false;

        $dispatcher->listen(
            LicenseRenewedEventInterface::class,
            function () use (&$listener_is_called) {
                $listener_is_called = true;
            }
        );

        $event = new LicenseRenewedEvent(
            '123',
            '2016-12-31',
            '2017-12-31',
            699.0,
            'first_add_on',
            'second_add_on'
        );

        $dispatcher->trigger($event);

        $this->assertTrue($listener_is_called);
    }

    public function testListenerIsNotCalldOnEventMissmatch()
    {
        $dispatcher = new EventsDispatcher();

        $listener_is_called = false;

        $dispatcher->listen(
            LicenseRenewedEventInterface::class,
            function () use (&$listener_is_called) {
                $listener_is_called = true;
            }
        );

        $event = new SubscriptionCanceledEvent('2016-12-31', 'small', 'monthly');
        $dispatcher->trigger($event);

        $this->assertFalse($listener_is_called);

        $event = new LicenseRenewedEvent(
            '123',
            '2016-12-31',
            '2017-12-31',
            699.0,
            'first_add_on',
            'second_add_on'
        );
        $dispatcher->trigger($event);

        $this->assertTrue($listener_is_called);
    }

    public function testGlobalListener()
    {
        $dispatcher = new EventsDispatcher();

        $number_of_listener_calls = 0;

        $dispatcher->listen(EventInterface::class, function () use (&$number_of_listener_calls) {
            $number_of_listener_calls++;
        });

        $dispatcher
            ->trigger(new SubscriptionCanceledEvent('2016-12-31', 'small', 'monthly'))
            ->trigger(
                new LicenseRenewedEvent(
                    '123',
                    '2016-12-31',
                    '2017-12-31',
                    699.0
                )
            );

        $this->assertSame(2, $number_of_listener_calls);
    }
}
