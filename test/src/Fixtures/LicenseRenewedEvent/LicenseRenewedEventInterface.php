<?php

/*
 * This file is part of the Active Collab EventsDispatcher project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\EventsDispatcher\Test\Fixtures\LicenseRenewedEvent;

use ActiveCollab\EventsDispatcher\Events\EventInterface;

interface LicenseRenewedEventInterface extends EventInterface
{
    public function getLicenseKey(): string;

    public function getOldExpirationDate(): string;

    public function getNewExpirationDate(): string;

    public function getPrice(): float;
}
