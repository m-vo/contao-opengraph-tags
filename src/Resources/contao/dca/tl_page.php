<?php

// website root
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = preg_replace(
    '~(\{meta_legend\}[^;]*;)~',
    '$1{mvo_og_tags_legend},mvo_og_tags_enabled, mvo_og_tags_images;',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['root']
);

// regular pages
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = preg_replace(
    '~(\{meta_legend\}[^;]*;)~',
    '$1{mvo_og_tags_legend},mvo_og_tags_images;',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']
);


$GLOBALS['TL_DCA']['tl_page']['fields']['mvo_og_tags_enabled'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_page']['mvo_og_tags_enabled'],
    'exclude'                 => true,
    'filter'                  => true,
    'inputType'               => 'checkbox',
    'sql'                     => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_page']['fields']['mvo_og_tags_images'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_page']['mvo_og_tags_images'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => [
        'multiple'   => true,
        'fieldType'  => 'checkbox',
        'orderField' => 'mvo_og_tags_images_order',
        'files'      => true,
    ],
    'sql'       => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_page']['fields']['mvo_og_tags_images_order'] = [
    'sql'       => "blob NULL"
];

