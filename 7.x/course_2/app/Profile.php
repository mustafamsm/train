<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Profile extends Model
{
    protected $fillable =[
        'province','gender',
        'user_id','bio','facebook'
    ];
    protected $table='profile_users';
   /**
         * Get the user that owns the Profile
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user() 
        {
            return $this->belongsTo(User::class, 'user_id',);
        }
    
}
