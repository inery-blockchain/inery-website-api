<?php

namespace App\Services;

use App\Mail\ThanksMail;
use App\Mail\JobReportMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function sendMail($data)
    {
        Mail::send(new JobReportMail($data));
        Mail::send(new ThanksMail($data));
    }

    public static function deleteUploadedFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
