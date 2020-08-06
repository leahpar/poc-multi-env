<?php


namespace App\SomeService;


class RandomService implements SomeServiceInterface
{

    public function doSomething(): ?string
    {
        return (string)rand(1000, 9999);
    }

}
