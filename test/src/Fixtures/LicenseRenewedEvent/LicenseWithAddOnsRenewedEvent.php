<?php

/*
 * This file is part of the Active Collab EventsDispatcher project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\EventsDispatcher\Test\Fixtures\LicenseRenewedEvent;

class LicenseWithAddOnsRenewedEvent extends LicenseRenewedEvent implements LicenseWithAddOnsRenewedEventInterface
{
    private $add_ons;

    public function __construct(
        string $license_key,
        string $old_expiration_date,
        string $new_expiration_date,
        float $price,
        string ...$add_ons
    )
    {
        parent::__construct($license_key, $old_expiration_date, $new_expiration_date, $price);

        $this->add_ons = $add_ons;
    }

    public function getAddOns(): array
    {
        return $this->add_ons;
    }
}
