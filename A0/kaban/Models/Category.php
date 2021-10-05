<?php

namespace Kaban\Models;


use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model {
    protected $guarded = [];
    use NodeTrait;

    /**
     * Country constructor.
     *
     * @param array $attributes
     */
    public function __construct( array $attributes = [] ) {
        parent::__construct( $attributes );
    }

    public static function table() {
        return ( new self )->getTable();
    }

    public function posts() {
        return $this->hasMany( Post::class );
    }

    public function getDashedTitleAttribute() {
        return "┘" . str_repeat( "─", $this->attributes['depth'] ) . ' ' . $this->title;
    }

    public function getParentTitleAttribute() {
        $parent = $this->parent;

        return ( $this->parent ) ? $this->parent->title : '';
    }

//    public function parent() {
//        return $this->belongsTo( Category::class );
//    }

}
