<?php // framework/tests/SessionTest.php

namespace EOkwukwe\Framework\Tests;

use EOkwukwe\Framework\Session\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        unset($_SESSION);
    }

    /** @test */
    public function set_and_get_flash(): void
    {
        $session = new Session();
        $session->setFlash('success', 'Great job!');
        $session->setFlash('error', 'Bad job!');

        $this->assertTrue($session->hasFlash('success'));
        $this->assertTrue($session->hasFlash('error'));

        $this->assertEquals(['Great job!'], $session->getFlash('success'));
        $this->assertEquals(['Bad job!'], $session->getFlash('error'));
        $this->assertEquals([], $session->getFlash('warning'));
    }
}
