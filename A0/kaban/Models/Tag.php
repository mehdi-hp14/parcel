<?php

namespace Kaban\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    protected $fillable = [
        'name',
        'type'
    ];

    /**
     * Tag constructor.
     *
     * @param array $attributes
     */
    public function __construct( array $attributes = [] ) {
        parent::__construct( $attributes );
    }

    public static function table() {
        return ( new self )->getTable();
    }


    public function media() {
        return $this->morphedByMany( Media::class, 'taggable' );
    }

    public function posts() {
        return $this->morphedByMany( Post::class, 'taggable' );
    }


}
