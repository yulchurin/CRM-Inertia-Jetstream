<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class InstructorScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $weekMap = ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'];
        return [
            'id' => $this->id,
            'student' => [
                'name' => $this->student?->name,
                'link' => $this->student?->person?->phone,
                'phone' => '(' .
                    Str::substr($this->student?->person?->phone, 0, 3) .') '.
                    Str::substr($this->student?->person?->phone, 3, 3) .'-'.
                    Str::substr($this->student?->person?->phone, 6, 2) .'-'.
                    Str::substr($this->student?->person?->phone, 8, 2),
            ],
            'date' => $this->date?->format('d.m.Y'),
            'start' => $this->schedule?->start?->format('H:i'),
            'dayOfWeek' => $weekMap[$this->date?->dayOfWeek],
            'end' => $this->schedule?->start?->addSeconds($this->schedule?->duration)?->format('H:i'),
            'car' => [
                'model' => $this->vehicle?->model,
                'number' => Str::substr($this->vehicle?->number, 0, 1) .' '.
                    Str::substr($this->vehicle?->number, 1, 3) .' '.
                    Str::substr($this->vehicle?->number, 4, 2) .' | '.
                    Str::substr($this->vehicle?->number, 6, 3),
            ],
            'place' => [
                'name' => $this->place?->name,
                'location' => $this->place?->location,
                'address' => $this->place?->address,
            ],
            'comment' => $this->comment,
        ];
    }
}
