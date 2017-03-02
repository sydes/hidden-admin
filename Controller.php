<?php

namespace Module\HiddenAdmin;

class Controller
{
    public static $routes = [
        ['GET', '/admin/settings/hidden-admin', 'HiddenAdmin@edit'],
        ['POST', '/admin/settings/hidden-admin', 'HiddenAdmin@update'],
    ];

    public function install()
    {
        $settings = settings('hidden-admin');
        $settings->set([
            'key'   => 'show',
            'value' => 'admin',
        ])->commit();
    }

    public function uninstall()
    {
        $settings = settings('hidden-admin');
        $settings->delete()->commit();
    }

    public function edit()
    {
        $settings = settings('hidden-admin');

        $d = document([
            'content' => view('hidden-admin/form', [
                'key'   => $settings->get('key'),
                'value' => $settings->get('value'),
            ]),
            'sidebar_right' => \H::saveButton().csrf_field(),
            'form_url' => '/admin/settings/hidden-admin',
        ]);
        $d->title = 'Hidden Admin Plugin';

        return $d;
    }

    public function update()
    {
        $settings = settings('hidden-admin');
        $request = app('request');
        $settings->set([
            'key'   => $request->input('key'),
            'value' => $request->input('value'),
        ])->commit();

        notify(t('saved'));
        return back();
    }
}
