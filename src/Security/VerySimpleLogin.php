<?php

namespace App\Security;

class VerySimpleLogin
{
    /**
     * @var string
     */
    private $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public function authenticate(string $password): bool
    {
        $hash = hash('sha256', $password);

        return $hash == $this->hash;
    }
}
