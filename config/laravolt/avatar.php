<?php

/*
 * Set specific configuration variables here
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    | Avatar use Intervention Image library to process image.
    | Meanwhile, Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */
    'driver' => env('IMAGE_DRIVER', 'gd'),

    // Initial generator class
    'generator' => \Laravolt\Avatar\Generator\DefaultGenerator::class,

    // Whether all characters supplied must be replaced with their closest ASCII counterparts
    'ascii' => false,

    // Image shape: circle or square
    'shape' => 'circle',

    // Image width, in pixel
    'width' => 32,

    // Image height, in pixel
    'height' => 32,

    // Number of characters used as initials. If name consists of single word, the first N character will be used
    'chars' => 2,

    // font size
    'fontSize' => 15,

    // convert initial letter in uppercase
    'uppercase' => true,

    // Right to Left (RTL)
    'rtl' => false,

    // Fonts used to render text.
    // If contains more than one fonts, randomly selected based on name supplied
    'fonts' => [__DIR__ . '/../fonts/OpenSans-Bold.ttf', __DIR__ . '/../fonts/rockwell.ttf'],

    // List of foreground colors to be used, randomly selected based on name supplied
    'foregrounds' => [
        '#FFFFFF',
        '#222222',
    ],

    // List of background colors to be used, randomly selected based on name supplied
    'backgrounds' => [
        '#ff1744', // Bright Red
        '#d500f9', // Bright Purple
        '#651fff', // Bright Indigo
        '#3d5afe', // Bright Blue
        '#00b0ff', // Bright Light Blue
        '#1de9b6', // Bright Aqua
        '#00e676', // Bright Green
        '#76ff03', // Bright Light Green
        '#c6ff00', // Bright Lime
        '#ffea00', // Bright Yellow
        '#ff9100', // Bright Orange
        '#ff3d00', // Bright Deep Orange
        '#ff6d00', // Bright Amber
        '#f50057', // Bright Pink
        '#6200ea', // Bright Deep Purple
        '#0091ea', // Bright Light Blue
        '#00c853', // Bright Green
        '#64dd17', // Bright Lime
        '#aeea00', // Bright Yellow Lime
        '#ffd600', // Bright Yellow
        '#ffab00', // Bright Amber
        '#ff6f00', // Bright Orange
        '#dd2c00', // Bright Deep Orange
        '#d50000', // Bright Red
        '#aa00ff', // Bright Purple
        '#304ffe', // Bright Indigo
        '#2962ff', // Bright Blue
        '#0097a7', // Bright Cyan
        '#00bfa5', // Bright Teal
        '#1b5e20', // Dark Green
        '#33691e', // Dark Lime
        '#827717', // Dark Yellow
        '#ffb300', // Bright Amber
        '#ff6f00', // Bright Orange
        '#bf360c', // Dark Deep Orange
    ],


    'border' => [
        'size' => 1,

        // border color, available value are:
        // 'foreground' (same as foreground color)
        // 'background' (same as background color)
        // or any valid hex ('#aabbcc')
        'color' => 'background',

        // border radius, currently only work for SVG
        'radius' => 0,
    ],

    // List of theme name to be used when rendering avatar
    // Possible values are:
    // 1. Theme name as string: 'colorful'
    // 2. Or array of string name: ['grayscale-light', 'grayscale-dark']
    // 3. Or wildcard "*" to use all defined themes
    'theme' => ['colorful'],

    // Predefined themes
    // Available theme attributes are:
    // shape, chars, backgrounds, foregrounds, fonts, fontSize, width, height, ascii, uppercase, and border.
    'themes' => [
        'grayscale-light' => [
            'backgrounds' => ['#edf2f7', '#e2e8f0', '#cbd5e0'],
            'foregrounds' => ['#a0aec0'],
        ],
        'grayscale-dark' => [
            'backgrounds' => ['#2d3748', '#4a5568', '#718096'],
            'foregrounds' => ['#e2e8f0'],
        ],
        'colorful' => [
            'backgrounds' => [
                '#D32F2F', // Dark Red
                '#C2185B', // Dark Pink
                '#7B1FA2', // Dark Purple
                '#512DA8', // Dark Indigo
                '#303F9F', // Dark Blue
                '#1976D2', // Dark Light Blue
                '#0288D1', // Dark Cyan
                '#0097A7', // Dark Teal
                '#00796B', // Dark Green
                '#388E3C', // Dark Light Green
                '#689F38', // Dark Lime
                '#AFB42B', // Dark Yellow
                '#FBC02D', // Dark Amber
                '#FFA000', // Dark Orange
                '#F57C00', // Dark Deep Orange
                '#E64A19', // Dark Red-Orange
                '#5D4037', // Dark Brown
                '#616161', // Dark Gray
                '#455A64', // Dark Blue-Gray
                '#263238', // Very Dark Blue-Gray
                '#1E88E5', // Bright Blue
                '#43A047', // Bright Green
                '#8E24AA', // Bright Purple
                '#D81B60', // Bright Pink
                '#F4511E', // Bright Deep Orange
                '#FB8C00', // Bright Orange
                '#FDD835', // Bright Yellow
                '#7CB342', // Bright Lime
                '#00ACC1', // Bright Cyan
                '#039BE5', // Bright Light Blue
                '#3949AB', // Bright Indigo
                '#8E44AD', // Bright Purple
                '#C0392B', // Bright Red
                '#E67E22', // Bright Orange
                '#F39C12', // Bright Yellow
                '#27AE60', // Bright Green
                '#16A085', // Bright Teal
                '#2980B9', // Bright Blue
                '#8E44AD', // Bright Purple
            ],


            'foregrounds' => ['#FFFFFF'],
        ],
        'pastel' => [
            'backgrounds' => [
                '#ef9a9a',
                '#F48FB1',
                '#CE93D8',
                '#B39DDB',
                '#9FA8DA',
                '#90CAF9',
                '#81D4FA',
                '#80DEEA',
                '#80CBC4',
                '#A5D6A7',
                '#E6EE9C',
                '#FFAB91',
                '#FFCCBC',
                '#D7CCC8',
            ],
            'foregrounds' => [
                '#FFF',
            ],
        ],
    ],
];
