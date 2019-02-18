<?php

/*
 * OpenGraph Tags bundle for Contao Open Source CMS
 *
 * @copyright  Copyright (c) $date, Moritz Vondano
 * @license MIT
 */

$GLOBALS['TL_HOOKS']['generatePage'][] = ['mvo_contao_opengraph_tags.listener.open_graph_tags', 'onInject'];
