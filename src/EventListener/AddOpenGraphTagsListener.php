<?php

/*
 * OpenGraph Tags bundle for Contao Open Source CMS
 *
 * @copyright  Copyright (c) $date, Moritz Vondano
 * @license MIT
 */

namespace Mvo\ContaoOpenGraphTags\EventListener;

use Contao\Environment;
use Contao\File;
use Contao\FilesModel;
use Contao\PageModel;

class AddOpenGraphTagsListener
{
    /** @var \Twig\Environment */
    private $twig;

    /**
     * AddOpenGraphTagsListener constructor.
     *
     * @param \Twig\Environment $twig
     */
    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param PageModel $objPage
     */
    public function onInject(PageModel $objPage): void
    {
        $objRootPage = PageModel::findById($objPage->rootId);

        if (null !== $objRootPage && $objRootPage->mvo_og_tags_enabled) {
            $GLOBALS['TL_HEAD'][] = self::generateMetaTags($objPage);
        }
    }

    /**
     * @param PageModel $objPage
     *
     * @return string
     */
    private function generateMetaTags(PageModel $objPage): string
    {
        $data = [
            'type' => 'website',
            'url' => Environment::get('uri'),
            'title' => $objPage->title,
            'images' => self::getImageAttributes($objPage),
            'locale' => self::getLocale($objPage),
        ];

        if ('' !== $objPage->description) {
            $data['description'] = $objPage->description;
        }
        if ('' !== $objPage->rootTitle) {
            $data['site_name'] = $objPage->rootTitle;
        }

        return $this->twig->render('@MvoContaoOpenGraphTags/meta_tags.html.twig', $data);
    }

    /**
     * @param PageModel $objPage
     *
     * @return array
     */
    private static function getImageAttributes(PageModel $objPage): array
    {
        // find closest image(s) in tree
        $images = null;
        do {
            if (null !== $objPage->mvo_og_tags_images_order && '' !== $objPage->mvo_og_tags_images_order) {
                $images = deserialize($objPage->mvo_mvo_og_tags_images);
            } elseif (null !== $objPage->mvo_og_tags_images && '' !== $objPage->mvo_og_tags_images) {
                $images = deserialize($objPage->mvo_og_tags_images);
            }
        } while (null === $images && null !== $objPage = PageModel::findById($objPage->pid));

        if (null === $images) {
            return [];
        }

        // get attributes
        $arrImageAttributes = [];
        foreach ($images as $imageUuid) {
            $imageAttributes = self::getImageAttribute($imageUuid);
            if (null !== $imageAttributes) {
                $arrImageAttributes[] = $imageAttributes;
            }
        }

        return $arrImageAttributes;
    }

    /**
     * @param PageModel $objPage
     *
     * @return string
     */
    private static function getLocale(PageModel $objPage): string
    {
        $fallbackLanguage = $objPage->language;

        // find closest locale setting in tree
        do {
            if ($objPage->mvo_og_tags_locale) {
                return $objPage->mvo_og_tags_locale;
            }
        } while (null !== $objPage = PageModel::findById($objPage->pid));

        // fallback: use language instead of locale (which is incorrect by spec but might get parsed anyhow)
        return $fallbackLanguage ?? '';
    }

    /**
     * @param string $imageUuid
     *
     * @return array|null
     */
    private static function getImageAttribute(string $imageUuid): ?array
    {
        $objFilesModel = FilesModel::findByUuid($imageUuid);

        if (null !== $objFilesModel && null !== $objFile = new File($objFilesModel->path)
        ) {
            $arrAttributes = $objFile->imageSize;

            return [
                'src' => $objFilesModel->path,
                'width' => $arrAttributes[0],
                'height' => $arrAttributes[1],
                'mime' => $arrAttributes['mime'],
            ];
        }

        return null;
    }
}
