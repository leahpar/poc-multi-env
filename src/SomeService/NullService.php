<?php


namespace App\SomeService;


class NullService implements SomeServiceInterface
{

    public function doSomething(): ?string
    {
        return null;
    }
}