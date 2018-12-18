<?php

namespace App\Tests\Security;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Security\VerySimpleLogin;

class VerySimpleLoginTest extends KernelTestCase
{
    public function testAuthenticateSuccess()
    {
        $hash = '10a6e6cc8311a3e2bcc09bf6c199adecd5dd59408c343e926b129c4914f3cb01';
        $login = new VerySimpleLogin($hash);
        $this->assertTrue($login->authenticate('test_password'));
    }

    public function testAuthenticateFail()
    {
        $hash = '10a6e6cc8311a3e2bcc09bf6c199adecd5dd59408c343e926b129c4914f3cb01';
        $login = new VerySimpleLogin($hash);
        $this->assertFalse($login->authenticate('test_wrong_password'));
    }

    public function testService()
    {
        self::bootKernel();

        self::$kernel->getContainer();

        $login = self::$container->get('security.login');

        $this->assertTrue($login->authenticate('test_password'));
    }
}
