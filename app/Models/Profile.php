<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function profileImage(){
        $imagePath=($this->image) ?$this->image:'profile\tPaBmYA3eZIgWYQEux0OtulagEQp7aGEJj4MqA8X.jpg';
        return '/storage/'.$imagePath;
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
