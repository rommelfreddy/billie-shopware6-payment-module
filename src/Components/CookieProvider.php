<?php

declare(strict_types=1);

/*
 * Copyright (c) Billie GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Billie\BilliePayment\Components;

use Shopware\Storefront\Framework\Cookie\CookieProviderInterface;

class CookieProvider implements CookieProviderInterface
{
    /**
     * @var CookieProviderInterface
     */
    private $originalService;

    public function __construct(CookieProviderInterface $service)
    {
        $this->originalService = $service;
    }

    public function getCookieGroups(): array
    {
        return array_merge(
            $this->originalService->getCookieGroups(),
            [
                [
                    'snippet_name' => 'billie.cookie.group_name',
                    'cookie' => 'billie-payment',
                    'isRequired' => true,
                ],
            ]
        );
    }
}
