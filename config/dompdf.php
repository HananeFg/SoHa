<?php

use Dompdf\Dompdf;

$pdf_options = [
    'default_paper_size' => 'ticket',
    'default_paper_orientation' => 'portrait',
    'custom_paper_sizes' => [
        'ticket' => [
            0,  // Width (in millimeters)
            80, // Height (in millimeters)
        ],
    ],
];
