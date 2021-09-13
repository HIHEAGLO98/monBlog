<?php

namespace App\Listeners;

use App\Events\ModelCreated as EventModelCreated;
use App\Notifications\ModelCreated as ModelCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ModelCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ModelCreated  $event
     * @return void
     */
    public function handle(EventModelCreated $event)
    {
        $event->model->notify(new ModelCreatedNotification);
    }
}
