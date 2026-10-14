<?php

namespace App\Service;

use Carbon\Carbon;
use Pimcore\Model\DataObject\Restaurant;

class RestaurantOpenStatusService
{

    public function getStatus(Restaurant $restaurant): array
    {
        $city = $restaurant->getCity();

        if (!$city || !$city->getTimezone()) {
            return ['open' => false, 'reason' => 'Timezone missing'];
        }

        $timezone = $city->getTimezone();
        $now = Carbon::now($timezone);

        $today = strtolower($now->format('l')); // monday, tuesday...

        /** @var \Pimcore\Model\DataObject\Data\Block $openingHours */
        $openingHours = $restaurant->getOpeningHours();

        if (!$openingHours || count($openingHours) === 0) {
            return ['open' => false, 'reason' => 'No opening hours'];
        }

        foreach ($openingHours as $row) {

            $day = strtolower($row['day']->getData());

            if ($day !== $today) {
                continue;
            }

            if ($row['isClosed']->getData()) {
                return [
                    'open' => false,
                    'reason' => 'Closed today',
                    'timezone' => $timezone
                ];
            }

            $openTime = Carbon::createFromFormat(
                'H:i',
                $row['openTime']->getData(),
                $timezone
            );
            
            $closeTime = Carbon::createFromFormat(
                'H:i',
                $row['closeTime']->getData(),
                $timezone
            );

            // Overnight handling (e.g. 18:00 → 02:00)
            if ($closeTime->lessThan($openTime)) {
                $closeTime->addDay();
            }

            $isOpen = $now->between($openTime, $closeTime);

            return [
                'open'      => $isOpen,
                'now'       => $now->format('H:i'),
                'opens_at'  => $openTime->format('H:i'),
                'closes_at' => $closeTime->format('H:i'),
                'timezone'  => $timezone
            ];
        }

        return ['open' => false, 'reason' => 'No timings for today'];
    }
}
    