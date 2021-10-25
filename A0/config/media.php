<?php

return [

    'mediables' => [
        strtolower( class_basename( \Kaban\Models\Post::class ) ) => \Kaban\Models\Post::class,
//		'spot_request'                                            => \Kaban\Models\SpotRequest::class,
    ],


    'default' => [
        'quality'            => 90,
        'width'              => null,
        'height'             => null,
        'ratio'              => true,
        'upsize'             => false,
        'resize_mode'        => null,
        'watermark_image'    => false,
        'watermark_position' => 'center',
        //top-left, top, top-right, left, center, right, bottom-left, bottom, bottom-right
        'watermark_offset_x' => 10,
        'watermark_offset_y' => 10,
        'watermark_text'     => '',
        'thumbnail'          => [
            'width'   => 90,
            'height'  => 90,
            'quality' => env( 'THUMBNAIL_QUALITY', 100 ),
            'type'    => null
        ]
    ],

    'video' => [
        'default' => [
            'quality'            => 60,
            'width'              => 870,
            'height'             => 490,
            'ratio'              => true,
            'upsize'             => false,
            'resize_mode'        => 'center',
            'watermark_image'    => public_path( 'watermark-new.png' ),
            'watermark_position' => 'bottom-right',
            'watermark_offset_x' => 0,
            'watermark_offset_y' => 0,
            'watermark_text'     => '',
            'thumbnail'          => [
                'width'       => 320,
                'height'      => 180,
                'quality'     => env( 'THUMBNAIL_QUALITY', 70 ),
                'resize_mode' => 'center'
            ]
        ],
        'admin'   => [
            'quality' => 90,
            'width'   => 1600,
            'height'  => 900,
        ],
    ],

    'review'    => [
        'default' => [
            'watermark_image'    => public_path( 'watermark-new.png' ),
            'watermark_position' => 'bottom-right',
            'watermark_offset_x' => 0,
            'watermark_offset_y' => 0,
        ],
    ],
    'gallery'   => [
        'default' => [
            'watermark_image'    => public_path( 'watermark-new.png' ),
            'watermark_position' => 'bottom-right',
            'watermark_offset_x' => 0,
            'watermark_offset_y' => 0,
        ],
    ],
    'post'      => [
        'default' => [
            'watermark_image'    => public_path( 'watermark-new.png' ),
            'watermark_position' => 'bottom-right',
            'watermark_offset_x' => 0,
            'watermark_offset_y' => 0,
        ],
    ],
    'dashboard' => [
        'quality'            => 60,
        'width'              => 960,
        'height'             => null,
        'ratio'              => true,
        'upsize'             => false,
        'resize_mode'        => null,
        'watermark_image'    => public_path( 'watermark-new.png' ),
        'watermark_position' => 'bottom-right',
        'watermark_offset_x' => 0,
        'watermark_offset_y' => 0,
        'watermark_text'     => '',
    ],

    /*'admin' => [
        'quality' => 90,
        'watermark_image' => public_path('watermark-new.png'),
        'watermark_position' => 'bottom-right',
        'watermark_offset_x' => 0,
        'watermark_offset_y' => 0,
    ],*/

    /**
     * example
     */
    /*'example' => [
        'default' => [
            'quality' => 60,
            'width' => 960,
            'height' => null,
            'ratio' => true,
            'upsize' => false,
            'watermark_image' => public_path('watermark-new.png'),
            'watermark_position' => 'bottom-right',
            'watermark_offset_x' => 0,
            'watermark_offset_y' => 0,
            'watermark_text' => '',
        ],
        'admin' => [
            'quality' => 90,
        ],
        'dashboard' => [
            'quality' => 60,
        ]
    ],*/
];
