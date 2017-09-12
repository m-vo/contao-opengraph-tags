<?php

// open graph tags
$GLOBALS['TL_HOOKS']['generatePage'][] = ['mvo_contao_opengraph_tags.listener.open_graph_tags', 'onInject'];