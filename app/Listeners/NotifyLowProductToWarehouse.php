<?php

namespace App\Listeners;

use App\Events\LowProduct;
use App\Models\User;
use App\Notifications\LowProductStock;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotifyLowProductToWarehouse implements ShouldQueue
{ 

    use InteractsWithQueue;
    public $afterCommit = true;

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
     * @param  LowProduct  $event
     * @return void
     */
    public function handle(LowProduct $event)
    {
        $gudang_users = User::getAllGudangUsers();
        Notification::send($gudang_users, new LowProductStock($event->event_data));
    }

    public function failed(LowProduct $event, $exception){
        return $exception; // how to throw ??
    }

    public function shouldDiscoverEvents(){
        return true;
    }
}
