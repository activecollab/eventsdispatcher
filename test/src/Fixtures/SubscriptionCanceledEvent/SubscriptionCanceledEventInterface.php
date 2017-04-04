<?php

/*
 * This file is part of the Active Collab EventsDispatcher project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\EventsDispatcher\Test\Fixtures\SubscriptionCanceledEvent;

interface SubscriptionCanceledEventInterface
{
    public function getReference(): string;

    public function getPlan(): string;

    public function getBillingPeriod(): string;
}
