<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Options extends Model
{
    use HasFactory;

    /**
     * UUID como chave primária
     */
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Campos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'text',
        'votes',
        'polls_id',
    ];

    /**
     * Gera automaticamente um UUID ao criar um novo registro
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Relacionamento: uma Option pertence a uma Poll
     */
    public function poll()
    {
        return $this->belongsTo(Poll::class, 'polls_id');
    }
}
