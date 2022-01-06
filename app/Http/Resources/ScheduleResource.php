<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'time' => $this->start?->format('H:i'),
            'duration' => static::secondsToHours($this->duration),
            'estimated' => $this->start?->addSeconds($this->duration)?->format('H:i'),
        ];
    }

    private static function secondsToHours(int $seconds): string
    {
        $sec = $seconds % 60;
        $min = ($seconds-$sec) / 60;
        $minutes = $min % 60;
        $hours = ($min - $minutes) / 60;

        $minutes = $minutes < 10 ? "0$minutes" : $minutes;
        return "$hours:$minutes";
    }
}
