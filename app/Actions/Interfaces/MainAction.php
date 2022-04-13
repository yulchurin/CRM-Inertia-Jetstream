<?php

namespace App\Actions\Interfaces;

interface MainAction
{
    public function __invoke(MainDTO $data);
}
