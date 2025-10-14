<?php

namespace App\Console\Commands;

use App\Models\NewsLetter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeeklyNewsletter;

class SendWeeklyNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-weekly-newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subject = 'This Week’s Updates from ' . config('app.name');
        $content = "Hello!\n\nHere’s what’s new this week:\n- New arrivals in our store\n- Exclusive offers\n- Upcoming events";

        $newsletters = NewsLetter::all();
        foreach ($newsletters as $newsletter) {
            Mail::to($newsletter->email)->send(new WeeklyNewsletter($subject, $content, $newsletter->email));
        }
        $this->info('Newsletter sent successfully');
    }   
}
