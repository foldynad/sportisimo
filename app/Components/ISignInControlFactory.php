<?php

declare(strict_types=1);

namespace App\Components;

interface ISignInControlFactory
{
    public function create(): SignInControl;
}
