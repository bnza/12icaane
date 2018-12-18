<?php

namespace App\Contexts;

use App\Entity\Speaker;
use App\Kernel;
use App\Tests\TestDatabaseManagerTrait;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Behat\MinkExtension\Context\MinkContext;

require_once __DIR__.'/../../../bin/.phpunit/phpunit-6.5/vendor/autoload.php';
require_once __DIR__.'/../../tdd/TestDatabaseManagerTrait.php';

class NavigationContext extends MinkContext
{
    use TestDatabaseManagerTrait;

    /**
     * @var SessionInterface
     */
    private $s2Session;

    public function __construct(SessionInterface $session, Kernel $kernel)
    {
        $this->s2Session = $session;
        self::$kernel = $kernel;
    }

    /**
     * @Given /^I (am)(\snot)? logged in$/
     *
     * @param string $loggedIn
     * @param string $loggedOut
     */
    public function iAmLoggedIn($loggedIn, $loggedOut = '')
    {
        $loggedIn = (bool) $loggedIn && !(bool) $loggedOut;
        Assert::assertEquals($this->s2Session->get('logged_in', false), $loggedIn);
    }

    /**
     * @Given /^I navigate to "([^"]*)"$/
     *
     * @param string $url
     */
    public function iNavigateTo($url)
    {
        $this->getSession()->visit($url);
    }

    /**
     * @Then /^I got (\d+) status$/
     *
     * @param string $status
     */
    public function iGotStatus($status)
    {
        $this->assertResponseStatus((int) $status);
    }

    /**
     * @Then /^I land to "([^"]*)"$/
     *
     * @param string $url
     */
    public function iLandTo($url)
    {
        $this->assertPageAddress($url);
    }

    /**
     * @Given /^I have the right DB schema$/
     */
    public function iHaveTheRightDBSchema()
    {
        self::updateDatabaseSchema(self::$kernel);
    }

    /**
     * @When /^I fill form with valid data:$/
     *
     * @param TableNode $table
     */
    public function iFillFormWithValidData(TableNode $table)
    {
        $page = $this->getSession()->getPage();

        foreach ($table->getHash() as $row) {
            $el = $page->findById($row['id']);
            if ('select' == $row['type']) {
                $el->selectOption($row['value']);
            } else {
                $el->setValue($row['value']);
            }
        }
    }

    /**
     * @When /^I click the "([^"]*)" button$/
     *
     * @param $id
     */
    public function iClickTheButton($id)
    {
        $page = $this->getSession()->getPage();
        $page->findById($id)->click();
    }

    /**
     * @Then I got the right registration number
     */
    public function iGotTheRightRegistrationNumber()
    {
        $page = $this->getSession()->getPage();
        $code = $page->findById('reg_code')->getText();
        $em = self::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $speakers = $em->getRepository(Speaker::class)->findBy(['email' => 'mail@example.net']);
        $id = (int) explode('-', $code)[1];
        Assert::assertEquals($speakers[0]->getId(), $id);
    }
}
