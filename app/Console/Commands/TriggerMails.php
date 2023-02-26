<?php

namespace App\Console\Commands;

use App\Models\MailSchedule;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Spatie\Sitemap\SitemapGenerator;

class TriggerMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:trigger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trigger mail which are in scheduler.';

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
     * @return int
     */
    public function handle()
    {
        $mails = MailSchedule::where("status", "CREATED")
            ->where("send_at", "<=", Carbon::now())
            ->orderBy("priority", "DESC")
            ->limit(12)
            ->get();
        foreach ($mails as $mail) {
            $to = $mail->to;
            $subject = $mail->subject;
            try {
                Mail::html($mail->html, function ($message) use ($to, $subject) {
                    $message->to($to)->subject($subject);
                });
                $mail->status = "SENT";
            } catch (Exception $err) {
                $mail->status = "FAILED";
            }
            $mail->save();
        }
        return 0;
    }
}
