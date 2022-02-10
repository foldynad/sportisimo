<?php

declare(strict_types=1);

namespace App;

final class App
{
    public const DESTINATION_FRONT_HOMEPAGE = ':Homepage:';
    public const DESTINATION_ADMIN_HOMEPAGE = ':Admin:Dashboard:';
    public const DESTINATION_AFTER_SIGN_IN = self::DESTINATION_ADMIN_HOMEPAGE;
    public const DESTINATION_AFTER_SIGN_OUT = self::DESTINATION_FRONT_HOMEPAGE;
}
