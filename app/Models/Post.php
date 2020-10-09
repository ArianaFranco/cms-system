<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    //If you would like to make all attributes mass assignable, you may define the $guarded property as an empty array:
    //protected $guarded = [];
    
    protected $fillable = [
        'user_id',
        'title',
        'post_image',
        'body',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
