<?php

namespace Kaban\Models;


use Kaban\General\Enums\EMediaType;

trait HasMedia {
    public function media() {
        return $this->morphToMany( Media::class, 'mediable', 'mediables' )->withPivot( 'album', 'tags', 'data' )->withTimestamps();
    }

    public function poster() {
        return $this->morphToMany( Media::class, 'mediable', 'mediables' )->withPivot( 'album', 'tags', 'data' )->where( 'type', EMediaType::poster )->withTimestamps();
    }

    public function getThePosterAttribute() {

        return $this->poster[0] ?? null;
    }

    public function backdrop() {
        return $this->morphToMany( Media::class, 'mediable', 'mediables' )->withPivot( 'album', 'tags', 'data' )->where( 'type', EMediaType::backdrop )->withTimestamps();
    }

    public function getTheBackdropAttribute() {
        return $this->backdrop[0] ?? null;
    }

    public function getMediableTypeNameAttribute() {
        return snake_case( class_basename( $this ) );
    }
}
