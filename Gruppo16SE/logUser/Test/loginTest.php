<?php
use PHPUnit\Framework\TestCase;
require_once('C:\Users\Iannaccone Vito\public_html\Gruppo16SE\logUser\login.php');

class loginTest extends TestCase{
    /** @test **/
	public function TestLoginSuccessfull(){
        $this->assertTrue(user_exists('10102311'),'utente non valido');
        $this->assertTrue(get_pwd_user('10102311')=='12344');
	}

    public function TestLoginWrongForUsername(){
        $exception=false;
        if(!(user_exists('101023aa'))){
            print('Username sbagliato!');
            $exception=true;
        }
        $this->assertTrue($exception,'Wrong Id Assert');
    }

    public function TestLoginWrongForPassword(){
        $exception=false;
            if(!(get_pwd_user('10102311')=='12354')){
                print('Password sbagliata!');
                $exception=true;
            }
            $this->assertTrue($exception,'Wrong Pass Assert');
    }
}

	
