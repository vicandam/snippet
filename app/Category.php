<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Category extends Model
{
    protected $appends = [
        'category_name'
    ];

    public function getCategoryNameAttribute()
    {
        return $this->name;
    }
    public function topic()
    {
        return $this->hasMany(Topic::class);
    }

    public function validate($input)
    {
        $validator = Validator::make($input, [
            'category' => 'required',
            'photo' => 'required',
        ]);

        return $validator->validate();
    }

    public function scopeFilterSearch($query, $input)
    {
        $keyword = ! empty($input['keyword'])    ? $input['keyword']  : null;

        if ($keyword) {
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        }

        return $query;
    }
}
