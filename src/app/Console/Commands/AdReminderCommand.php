<?php

namespace App\Console\Commands;

use App\Mail\AdReminderMail;
use App\Repositories\AdRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AdReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ad:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder advertisers that they ads tomorrow';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws \App\Exceptions\CustomQueryException
     */
    public function handle()
    {
        $adRepository = new AdRepository();
        $adsOfTomorrow = $adRepository->findAll(['start_date' => date('Y-m-d', strtotime(date('Y-m-d') .'+1 day'))]);
        foreach ($adsOfTomorrow as $item){
            Mail::to($item->user->email)->send(new AdReminderMail("Ad Reminder", $item->user, $item));
        }
    }
}
