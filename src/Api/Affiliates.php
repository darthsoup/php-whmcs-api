<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Affiliates extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/affiliateactivate/
     */
    public function affiliateActivate(int $userId)
    {
        return $this->send('AffiliateActivate', ['userid' => $userId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getaffiliates/
     */
    public function getAffiliates(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['userid', 'visitors', 'paytype', 'payamount', 'onetime', 'balance', 'withdrawn']);

        return $this->send('GetAffiliates', $resolver->resolve($parameters));
    }
}
