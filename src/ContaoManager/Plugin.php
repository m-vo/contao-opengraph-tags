<?php

/*
 * OpenGraph Tags bundle for Contao Open Source CMS
 *
 * @copyright  Copyright (c) $date, Moritz Vondano
 * @license MIT
 */

namespace Mvo\ContaoOpenGraphTags\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Mvo\ContaoOpenGraphTags\MvoContaoOpenGraphTagsBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(MvoContaoOpenGraphTagsBundle::class)
                ->setLoadAfter(
                    [
                        \Contao\CoreBundle\ContaoCoreBundle::class,
                        \Symfony\Bundle\TwigBundle\TwigBundle::class,
                    ]
                ),
        ];
    }
}
