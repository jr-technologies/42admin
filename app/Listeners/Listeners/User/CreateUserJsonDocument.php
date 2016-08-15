<?php

namespace App\Listeners\Listeners\User;

use App\Events\Events\User\UserCreated;
use App\Libs\Json\Creators\Creators\User\UserJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateUserJsonDocument extends Listener implements ListenerInterface
{
    private $usersJsonRepository = null;

    /**
     * @param UsersJsonRepository $usersJsonRepository
     * Create the event listener.
     */
    public function __construct(UsersJsonRepository $usersJsonRepository)
    {
        $this->usersJsonRepository = $usersJsonRepository;
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return bool
     */
    public function handle(UserCreated $event)
    {
        $userJsonCreator = new UserJsonCreator($event->user);
        $userJson = $userJsonCreator->create();
        return $this->usersJsonRepository->store($userJson);
    }
}
