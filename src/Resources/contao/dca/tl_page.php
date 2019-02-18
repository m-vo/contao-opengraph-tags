<?php

/*
 * OpenGraph Tags bundle for Contao Open Source CMS
 *
 * @copyright  Copyright (c) $date, Moritz Vondano
 * @license MIT
 */

$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = preg_replace(
    '~(\{meta_legend\}[^;]*;)~',
    '$1{mvo_og_tags_legend},mvo_og_tags_enabled,mvo_og_tags_locale,mvo_og_tags_images;',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['root']
);

// regular pages
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = preg_replace(
    '~(\{meta_legend\}[^;]*;)~',
    '$1{mvo_og_tags_legend},mvo_og_tags_locale,mvo_og_tags_images;',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']
);

$GLOBALS['TL_DCA']['tl_page']['fields']['mvo_og_tags_enabled'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['mvo_og_tags_enabled'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['mvo_og_tags_locale'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['mvo_og_tags_locale'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['mvo_og_tags_images'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['mvo_og_tags_images'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => [
        'multiple' => true,
        'fieldType' => 'checkbox',
        'orderField' => 'mvo_og_tags_images_order',
        'files' => true,
        'tl_class' => 'w50',
    ],
    'sql' => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_page']['fields']['mvo_og_tags_images_order'] = [
    'sql' => 'blob NULL',
];
