<?php


namespace App\SomeService;


class FixedService implements SomeServiceInterface
{

    public function doSomething(): ?string
    {
        return "42";
    }

}
