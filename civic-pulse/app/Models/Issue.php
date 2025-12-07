<?php  // Start PHP code

namespace App\Models;  // This model is stored under app/Models directory


use Illuminate\Database\Eloquent\Model;      // Import the base Model class (gives DB functions)
use Illuminate\Database\Eloquent\Factories\HasFactory;  // Import HasFactory for creating fake data


class Issue extends Model
{
       use HasFactory;   // Allows use of Issue::factory() for test data


        protected $fillable = [   // Only these fields can be mass-assigned
        'title',          // Title of the issue
        'description',    // Description text
        'status',         // Status (example: open, closed, pending)
        'image_path' ,     // Path to the image (optional)
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}