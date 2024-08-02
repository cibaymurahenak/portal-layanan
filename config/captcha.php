<?php

return [
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['0','1','2', '3', '4', '6', '7', '8', '9'],
    'default' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'math' => false,
        'expire' => 60,
        'encrypt' => false,
        'bgColor' => '#FFFFFF', // Warna latar belakang putih
        'fontColors' => ['#000000'], // Warna font hitam
        'lines' => 0, // Menghilangkan garis
        'bgImage' => false, // Tidak menggunakan gambar latar belakang
    ],
    'math' => [
        'length' => 9,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'math' => true,
        'bgColor' => '#FFFFFF', // Warna latar belakang putih
        'fontColors' => ['#000000'], // Warna font hitam
        'lines' => 0, // Menghilangkan garis
        'bgImage' => false, // Tidak menggunakan gambar latar belakang
    ],
    'flat' => [
        'length' => 6,
        'width' => 160,
        'height' => 46,
        'quality' => 90,
        'lines' => 0, // Menghilangkan garis
        'bgImage' => false, // Tidak menggunakan gambar latar belakang
        'bgColor' => '#FFFFFF', // Warna latar belakang putih
        'fontColors' => ['#000000'], // Warna font hitam
        'contrast' => -5,
    ],
    'mini' => [
        'length' => 3,
        'width' => 60,
        'height' => 32,
        'bgColor' => '#FFFFFF', // Warna latar belakang putih
        'fontColors' => ['#000000'], // Warna font hitam
        'lines' => 0, // Menghilangkan garis
        'bgImage' => false, // Tidak menggunakan gambar latar belakang
    ],
    'inverse' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'sensitive' => true,
        'angle' => 12,
        'sharpen' => 10,
        'blur' => 2,
        'invert' => false,
        'contrast' => -5,
        'bgColor' => '#FFFFFF', // Warna latar belakang putih
        'fontColors' => ['#000000'], // Warna font hitam
        'lines' => 0, // Menghilangkan garis
        'bgImage' => false, // Tidak menggunakan gambar latar belakang
    ],
];
