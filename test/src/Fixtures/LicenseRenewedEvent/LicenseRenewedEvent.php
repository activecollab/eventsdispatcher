<?php

/*
 * This file is part of the Active Collab EventsDispatcher project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\EventsDispatcher\Test\Fixtures\LicenseRenewedEvent;

use ActiveCollab\EventsDispatcher\Events\Event;
use ActiveCollab\EventsDispatcher\Test\Fixtures\LicenseRenewedEvent\LicenseRenewedEventInterface;

class LicenseRenewedEvent extends Event implements LicenseRenewedEventInterface
{
    private $license_key;

    private $old_expiration_date;

    private $new_expiration_date;

    private $price;

    public function __construct(
        string $license_key,
        string $old_expiration_date,
        string $new_expiration_date,
        float $price
    )
    {
        $this->license_key = $license_key;
        $this->old_expiration_date = $old_expiration_date;
        $this->new_expiration_date = $new_expiration_date;
        $this->price = $price;
    }

    public function getLicenseKey(): string
    {
        return $this->license_key;
    }

    public function getOldExpirationDate(): string
    {
        return $this->old_expiration_date;
    }

    public function getNewExpirationDate(): string
    {
        return $this->new_expiration_date;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
