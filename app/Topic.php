<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Topic extends Model
{
    protected $dates = [
        'created_at',
    ];

    public function getCreatedAtAttribute($date)
    {
        $date = Carbon::parse($date);
        $elapsed = $date->diffForHumans();

        return $elapsed;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeSearchFilter($query, $keyword)
    {
        return $query->whereHas('category', function($category) use ($keyword) {
            $category->where('categories.name', 'like', '%' .$keyword. '%')
                ->orWhere('topics.title', 'like', '%' .$keyword. '%');
        });
    }

    public function validate($input)
    {
        $validator = Validator::make($input, [
            'category' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);

        return $validator->validate();
    }
}
