<?php

/*
 * This file is part of the Active Collab EventsDispatcher project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\EventsDispatcher;

use ActiveCollab\EventsDispatcher\Events\EventInterface;

interface EventsDispatcherInterface
{
    public function trigger(EventInterface $event): EventsDispatcherInterface;

    public function listen(string $event_type, callable ...$listeners): EventsDispatcherInterface;
}
