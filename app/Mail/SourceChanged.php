<?php

namespace App\Mail;

use App\Models\Source;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SourceChanged extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The source instance.
     *
     * @var array
     */
    public $source;

    /**
     * The sentence.
     *
     * @var array
     */
    public $sentence;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Source $source, string $sentence)
    {
        $this->source = $source;
        $this->sentence = $sentence;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.source.changed')
            ->subject($this->source->username.'/'.$this->source->repository.' has grown on Github');
    }
}
