<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao;

use Contao\CoreBundle\Fragment\FragmentRegistryInterface;
use Contao\CoreBundle\Fragment\PageType\PageTypeRendererInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Proxy for new page type fragments so they are accessible via $GLOBALS['TL_PTY'].
 *
 * @author Yanick Witschi <https://github.com/toflar>
 */
class PageProxy
{
    /**
     * @return Response
     */
    public function getResponse()
    {
        global $objPage;
        $container = \System::getContainer();
        $response = new Response();

        /** @var PageTypeRendererInterface $pageTypeRenderer */
        $pageTypeRenderer = $container->get(FragmentRegistryInterface::PAGE_TYPE_RENDERER);

        $result = $pageTypeRenderer->render($objPage);

        if (null !== $result) {
            $response->setContent($result);
        }

        return $response;
    }
}