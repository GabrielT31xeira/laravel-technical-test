<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Polls extends Model
{
    use HasFactory;

    /**
     * Indica que a chave primária não é auto incrementável.
     */
    public $incrementing = false;

    /**
     * Define o tipo da chave primária.
     */
    protected $keyType = 'string';

    /**
     * Campos que podem ser atribuídos em massa.
     */
    protected $fillable = [
        'question',
        'status',
        'start_date',
        'end_date',
    ];

    /**
     * Converte automaticamente para tipos nativos do PHP.
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Gera automaticamente o UUID ao criar um novo registro.
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

    public function options()
    {
        return $this->hasMany(Options::class, 'polls_id');
    }
}
