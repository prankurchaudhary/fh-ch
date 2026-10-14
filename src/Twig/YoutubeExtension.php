<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class YoutubeExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('youtube_id', [$this, 'getYoutubeId']),
        ];
    }

    public function getYoutubeId(string $url): ?string
    {
        preg_match(
            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            $url,
            $matches
        );

        return $matches[1] ?? null;
    }
}
