<?php

namespace App\Contexts;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

class NavigationContext implements Context
{
    /**
     * @When /^I navigate to "([^"]*)"$/
     */
    public function iNavigateTo($url)
    {
        throw new PendingException();
    }
}