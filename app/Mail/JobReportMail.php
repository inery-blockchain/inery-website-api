<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobReportMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('email.job-report', ['data' => $this->data])
            ->to('ap@inery.io') // ovde mora da stizu!!! jobopportunities@inery.io
            ->subject('Job report')
            // ->from($this->data['email'])
            ->attach($this->data['path1']);

        if (!empty($this->data['path2'])) {

            $email->attach($this->data['path2']);
        }
    }
}
