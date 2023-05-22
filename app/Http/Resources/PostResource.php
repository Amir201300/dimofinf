<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => substr($this->description,0,512),
            'phone' => $this->phone,
            'date'=>DateHelper::getInstance()->customDateFormat($this->created_at),
            'time'=>DateHelper::getInstance()->customTimeFormat($this->created_at),
        ];
    }
}
