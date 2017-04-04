<?php

/*
 * This file is part of the Active Collab EventsDispatcher project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\EventsDispatcher\Test\Fixtures\LicenseRenewedEvent;

interface LicenseWithAddOnsRenewedEventInterface extends LicenseRenewedEventInterface
{
    public function getAddOns(): array;
}
