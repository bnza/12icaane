<?php

namespace App\Contexts;

use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\MinkContext;

require_once(__DIR__ . '/../../../bin/.phpunit/phpunit-6.5/vendor/autoload.php');

class NavigationContext extends MinkContext
{
    /**
     * @var SessionInterface
     */
    private $s2Session;

    public function __construct(SessionInterface $session)
    {
        $this->s2Session = $session;
    }

    /**
     * @Given /^I (am)(\snot)? logged in$/
     */
    public function iAmLoggedIn($loggedIn, $loggedOut = '')
    {
        $loggedIn = (bool) $loggedIn && !(bool) $loggedOut;
        Assert::assertEquals($this->s2Session->get('logged_in', false), $loggedIn);
    }


    /**
     * @When /^I navigate to "([^"]*)"$/
     */
    public function iNavigateTo($url)
    {
        $this->getSession()->visit($url);
    }

    /**
     * @Then /^I got (\d+) status$/
     */
    public function iGotStatus($status)
    {
        $this->assertResponseStatus((int) $status);
    }

    /**
     * @Then /^I land to "([^"]*)"$/
     */
    public function iLandTo($url)
    {
        $this->assertPageAddress($url);
    }
}