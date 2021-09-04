<?php

namespace Tests\Feature\Console\Commands;

use App\Models\Ad;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AdReminderCommandTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    public function testAdReminderCommand()
    {
        $this->artisan('ad:reminder')
            ->assertExitCode(0);
    }
}
