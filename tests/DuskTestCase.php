<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\BeforeClass;

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Prepare for Dusk test execution.
     */
    #[BeforeClass]
    public static function prepare(): void
    {
        
    }

    /**
     * Create the RemoteWebDriver instance.
     */
    protected function driver()
{
    $options = (new ChromeOptions)->addArguments([
        '--disable-gpu',
        '--headless=new',
        '--no-sandbox',
        '--window-size=1920,1080',
    ]);

    return RemoteWebDriver::create(
        'http://localhost:8010',
        new DesiredCapabilities([
            'browserName' => 'chrome',
            'platform' => 'ANY',
            'goog:chromeOptions' => [
                'args' => $options->toArray()['args']
            ]
        ])
    );
}

}
