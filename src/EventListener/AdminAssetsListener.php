<?php

namespace App\EventListener;

use Pimcore\Event\BundleManager\PathsEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminAssetsListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
        'pimcore.admin.js_paths' => 'onFetchJsPaths',
        'pimcore.admin.css_paths' => 'onFetchCssPaths' // Add this
    ];
    }

    public function onFetchJsPaths(PathsEvent $event): void
    {
        $event->setPaths(array_merge($event->getPaths(), [
            '/static/js/pimcore/wysiwyg-sticky.js'
        ]));
    }

    public function onFetchCssPaths(PathsEvent $event): void
    {
        $event->setPaths(array_merge($event->getPaths(), [
            '/static/css/tinymce.css'
        ]));
    }
}




