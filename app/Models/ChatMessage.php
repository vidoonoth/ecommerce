<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'recipient_id',
        'message',
        'read_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
