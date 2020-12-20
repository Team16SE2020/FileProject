<?php
use PHPUnit\Framework\TestCase;
require_once('C:\Users\Iannaccone Vito\public_html\Gruppo16SE\logUser\moduloSign.php');

class moduloSignTest extends TestCase
{
    /** @test * */
    public function TestInsertUtenteSuccessfull()
    {
        $this->assertTrue(insert_utente('clora@ctm.it', 'Planner', '58964158', '45899', 'Clorindo', 'Rana'));
    }
}

