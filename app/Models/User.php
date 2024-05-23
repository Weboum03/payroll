<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements JWTSubject, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    public const MEDIA_COLLECTION_PROFILE_PICTURE = 'user_profile_picture';

    public const MEDIA_COLLECTIONS = [self::MEDIA_COLLECTION_PROFILE_PICTURE, 'aadhar_proof', 'pan_proof'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function info()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    protected function uploadMediaAction($collection, $temporaryPath)
    {
        
        if (!Storage::exists($temporaryPath)) {
            return false;
        }
        // Get the file from the temporary path
        $temporaryFile = Storage::path($temporaryPath);

        // Move the file to the user's media collection
        $response = $this->addMedia($temporaryFile)->toMediaCollection($collection);
        // Delete the temporary file
        Storage::delete($temporaryPath);
        return $response;
    }

    public function uploadMedia($collection, $temporaryPaths)
    {
        if (is_array($temporaryPaths)) {
            foreach ($temporaryPaths as $path) {
                $this->uploadMediaAction($collection, $path);
            }
        } else {
            return $this->uploadMediaAction($collection, $temporaryPaths);
        }

        return true;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if (!$model->password) {
                $model->password = 123456;
            }
            if (!$model->phone) {
                $model->phone = 1234567894;
            }
            if (!$model->employee_id) {
                $model->employee_id = time();
            }
            $model->name = $model->first_name . ' ' . $model->last_name;
        });

        self::updating(function ($model) {
            $model->name = $model->first_name . ' ' . $model->last_name;
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    // public function registerMediaCollections(): void
    // {
    //     $this->addMediaCollection('my-collection');
    //         //add options

    //     // you can define as many collections as needed
    //     $this->addMediaCollection('my-other-collection');
    //         //add options
    // }

    public function registerMediaCollections(): void
    {
        foreach (self::MEDIA_COLLECTIONS as $collectionName) {
            $this->addMediaCollection($collectionName)
                ->useDisk('media');
        }
    }
}
