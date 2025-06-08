<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use function Symfony\Component\Translation\t;

class InsertTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testInsertNotwork(): void
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->assertSee('Full Name')
                ->type('full_name', 'John Doe')
                ->type('username', 'johndoe')
                ->type('phone', '1234567890')
                ->type('whatsapp_number', '01556908736')
                //->waitFor('@whatsapp-check-button', 15)
                //->scrollTo('@whatsapp-check-button')
                //->click('@whatsapp-check-button')
                //->waitForText('Verified', 10)
                //->assertSee('Verified')
                ->type('address', '123 Main St')
                ->type('email', '123@gmail.com')
                ->type('password', 'password123')
                ->type('confirm_password', 'password123')
                ->scrollTo('button[name="Submit"]') 
                ->waitFor('button[name="Submit"]', 5) 
                ->mouseover('button[name="Submit"]')
                ->clickAtXPath("//button[@name='Submit']")
                ->waitForDialog(5)
                ->assertDialogOpened('Please fix the errors below.')
                ->acceptDialog();
    });
}
public function testInsertWork(): void
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->assertSee('Full Name')
                ->type('full_name', 'John Doe')
                ->type('username', 'johndoe81')
                ->type('phone', '1234567890')
                ->type('whatsapp_number', '01556908736')
                //->waitFor('@whatsapp-check-button', 15)
                //->scrollTo('@whatsapp-check-button')
                //->click('@whatsapp-check-button')
                //->waitForText('Verified', 10)
                //->assertSee('Verified')
                ->type('address', '123 Main St')
                ->type('email', '12338883@gmail.com')
                ->type('password', 'password1223$')
                ->type('confirm_password', 'password1223$')
                ->scrollTo('button[name="Submit"]') 
                ->waitFor('button[name="Submit"]', 5) 
                ->mouseover('button[name="Submit"]')
                ->clickAtXPath("//button[@name='Submit']")
                ->waitForDialog(5)
                ->assertDialogOpened('Account created successfully.')
                ->acceptDialog();
    });
}
public function testWhatsAppNumberNotvaild():void{
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->type('whatsapp_number','01556908736')
                ->waitFor('@whatsapp-check-button', 15)
                ->scrollTo('@whatsapp-check-button')
                ->click('@whatsapp-check-button')
                ->waitForText('Not Valid', 10)
                ->assertSee('Not Valid');
                
               
});
}
public function testWhatsAppNumbervaild():void{
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->type('whatsapp_number','01556908736')
                ->waitFor('@whatsapp-check-button', 15)
                ->scrollTo('@whatsapp-check-button')
                ->click('@whatsapp-check-button')
                ->waitForText('Verified', 10)
                ->assertSee('Verified');
               
});
}
}
