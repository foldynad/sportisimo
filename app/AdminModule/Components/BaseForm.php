<?php

declare(strict_types=1);

namespace App\AdminModule\Components;

use Nette\Application\UI\Control;

abstract class BaseForm extends Control
{
    public function render()
    {
        $this->template->setFile(__DIR__ . '/baseForm.latte');
        $this->template->render();
    }
}
