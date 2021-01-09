<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;
use App\Notifications\TransactionsNotification;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;
    use LaratrustUserTrait;
    use SoftDeletes;
    use Billable;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password', 'credits', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
    public function getImageUrlAttribute($value)
    {
        $imageUrl = '';
        //check if image exist
        if(!is_null($this->image))
        {
            $imagePath = public_path() ."/images/". $this->image;
            if(file_exists($imagePath))
            {
                $imageUrl = asset("images/" . $this->image);
            }
        }else{
            $imageUrl = "/images/". "unknown.png";
        }
        return $imageUrl;
    }
    public function chargeCredits($hours, Room $room)
    {
        $amount = $hours * (int) $room->hourly_rate * 100;
       
        if ($this->credits < $amount) {
            return false;
        }

        $this->credits -= $amount;
        $this->save();

        Transaction::create([
            'user_id'      => $this->id,
            'room_id'      => $room->id,
            'paid_amount'  => $amount,
            'booking_time' => $hours,
        ]);
        $admin = User::where('id', 1)->first();
        //notifiy the admin about the transaction
        $id = Transaction::latest()->first()->id;
        $admin->notify(new TransactionsNotification(Transaction::findOrFail($id)));

        return true;
    }

}
