<?php

namespace Module\HiddenAdmin;

use App\Event;

class Handlers
{
    public function __construct(Event $events)
    {
        $events->on('route.found', 'admin/*', function () {
            if ($this->isGuestAndWithoutPass()) {
                app()['section'] = 'front';

                $context = app('event')->getContext();
                app('event')->setContext(str_replace('admin/', 'front/', $context));

                abort(404);
            }
        }, 2);
    }

    private function isGuestAndWithoutPass()
    {
        $request = app('request');
        $settings = settings('hidden-admin');

        return !app('user')->isLoggedIn() &&
        (!$request->has($settings->get('key')) ||
            $request->input($settings->get('key')) !== $settings->get('value'));
    }
}
