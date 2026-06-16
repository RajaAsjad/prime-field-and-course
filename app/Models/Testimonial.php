<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'testimonials';
    public $timestamps = true;
    protected $fillable = ['name', 'slug', 'designation', 'image', 'comment', 'status'];

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('assets/website/images/testimonial-1.jpg');
        }

        $adminPath = public_path('admin/assets/images/testimonials/' . $this->image);
        if (file_exists($adminPath)) {
            return asset('public/admin/assets/images/testimonials/' . $this->image);
        }

        return asset('assets/website/images/' . $this->image);
    }
}
