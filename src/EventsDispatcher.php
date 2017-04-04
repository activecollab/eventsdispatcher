<?php

/*
 * This file is part of the Active Collab EventsDispatcher project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\EventsDispatcher;

use ActiveCollab\EventsDispatcher\Events\EventInterface;
use InvalidArgumentException;
use ReflectionClass;

class EventsDispatcher implements EventsDispatcherInterface
{
    private $listeners = [];

    public function trigger(EventInterface $event): EventsDispatcherInterface
    {
        foreach ($this->listeners as $listeners_listens_to => $listeners) {
            if ($this->shouldCallListeners($event, $listeners_listens_to)) {
                foreach ($listeners as $listener) {
                    call_user_func($listener, $event);
                }
            }
        }

        return $this;
    }

    private function shouldCallListeners(EventInterface $event, string $listeners_listens_to): bool
    {
        return $event instanceof $listeners_listens_to;
    }

    public function listen(string $event_type, callable ...$listeners): EventsDispatcherInterface
    {
        if (!array_key_exists($event_type, $this->listeners) && $this->validateEventType($event_type)) {
            $this->listeners[$event_type] = [];
        }

        $this->listeners[$event_type] = array_merge($this->listeners[$event_type], $listeners);

        return $this;
    }

    private function validateEventType(string $event_class): bool
    {
        if (!class_exists($event_class, true) && !interface_exists($event_class, true)) {
            throw new InvalidArgumentException('Event class does not exist.');
        }

        if (!(new ReflectionClass($event_class))->implementsInterface(EventInterface::class)) {
            throw new InvalidArgumentException('Event class does not implement EventInterface.');
        }

        return true;
    }
}
