<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = [];
    protected $table = 'content';

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function replyContents()
    {
        return $this->hasMany(ReplyContent::class);
    }

    /**
     * @return mixed
     */
    public function getDetails(): array
    {
        $total = $this->replyContents->count();
        $typeId = $this->type_id;
        $details = $this->replyContents->pluck('answer');
        if ($typeId == Type::CHOICES) {
            $details = $details->flatten();
        }

        return $details->countBy()
                       ->map(function ($item, $key) use ($total, $typeId) {
                           return [
                               'name'       => $typeId == Type::SIMPLE_TEXT ? $key : Answer::find($key)->text,
                               'count'      => $item,
                               'percentage' => round($item / $total, 2) * 100 . '%'
                           ];
                       })
                       ->values()
                       ->all();
    }
}
