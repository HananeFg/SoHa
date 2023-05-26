<?php

use Dompdf\Dompdf;

$pdf_options = [
    'default_paper_size' => 'ticket',
    'default_paper_orientation' => 'portrait',
    'custom_paper_sizes' => [
        'ticket' => [
            26.772, // Width (in points)
            41.732, // Height (in points)
        ],
    ],
];