<?php

/*
 * This file is part of the Active Collab EventsDispatcher project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\EventsDispatcher\Test\Fixtures\SubscriptionCanceledEvent;

use ActiveCollab\EventsDispatcher\Events\Event;

class SubscriptionCanceledEvent extends Event implements SubscriptionCanceledEventInterface
{
    private $reference;

    private $plan;

    private $billing_period;

    public function __construct(string $reference, string $plan, string $billing_period)
    {
        $this->reference = $reference;
        $this->plan = $plan;
        $this->billing_period = $billing_period;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getPlan(): string
    {
        return $this->plan;
    }

    public function getBillingPeriod(): string
    {
        return $this->billing_period;
    }
}
