<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/bhw/maternal-care')
                ->type('serial_no', '12345')
                ->type('full_name', 'Jane Doe')
                ->type('address', '123 Main St')
                ->select('se_status', 'NHTS')
                ->type('age', '30')
                ->type('lmp', '2025-01-01')
                ->type('edc', '2025-10-01')
                ->type('first_tri', '2025-02-01')
                ->type('second_tri', '2025-05-01')
                ->type('third_tri', '2025-08-01')
                ->type('td1', '2025-01-15')
                ->type('td2', '2025-02-15')
                ->type('td3', '2025-03-15')
                ->type('td4', '2025-04-15')
                ->type('td5', '2025-05-15')
                ->type('iron_visit1', '2025-01-10')
                ->type('iron_tablets_1', '30')
                ->type('iron_visit2', '2025-02-10')
                ->type('iron_tablets_2', '30')
                ->type('iron_visit3', '2025-03-10')
                ->type('iron_tablets_3', '30')
                ->type('iron_visit4', '2025-04-10')
                ->type('iron_tablets_4', '30')
                ->type('cal_visit2', '2025-02-20')
                ->type('cal_tablets_2', '30')
                ->type('cal_visit3', '2025-03-20')
                ->type('cal_tablets_3', '30')
                ->type('cal_visit4', '2025-04-20')
                ->type('cal_tablets_4', '30')
                ->type('iodine_visit1', '2025-01-05')
                ->select('bmi', 'Normal: 18.5 - 22.9')
                ->type('deworming_tablet', '2025-01-25')
                ->type('syph', '2025-01-30')
                ->type('hepa', '2025-02-05')
                ->type('hiv', '2025-02-10')
                ->select('rpr_or_rdt', 'Negative')
                ->select('hbsag', 'Negative')
                ->press('Submit')
                ->assertPathIs('/bhw/maternal-care')
                ->assertSee('Record added successfully');
        });
    }
}
