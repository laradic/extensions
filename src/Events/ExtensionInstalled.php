<?php namespace Laradic\Extensions\Events;

use Illuminate\Queue\SerializesModels;
use Laradic\Extensions\Contracts\Extension;

class ExtensionInstalled extends Event
{

    use SerializesModels;

    protected $extension;

    public function __construct(Extension $extension)
    {
        $this->extension = $extension;
    }
}
