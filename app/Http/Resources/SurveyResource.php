<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
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
           'sequence'       => $this->id,
           'title'          => $this->name,
           'created_at'     => $this->getDateTime($this->created_at),
           'updated_at'     => $this->getDateTime($this->updated_at),
           'question_count' => $this->contents->count(),
           'status'         => $this->status,
           'response_count' => $this->replyMasters->count(),
           'response_time'  => $this->getDateTime($this->replyMasters->max('updated_at')),
           'view_link'      => '/admin/survey/' . $this->id,
           'edit_link'      => '/admin/survey/edit/' . $this->id,
       ];
    }

    private function getDateTime(?Carbon $time): string
    {
        return $time ? $time->format('Y-m-d H:i:s') : 'N/A';
    }

}
