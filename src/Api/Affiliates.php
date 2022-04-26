<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Affiliates extends AbstractApi
{
    public function affiliateActivate(int $userId)
    {
        return $this->send('AffiliateActivate', ['userid' => $userId]);
    }

    public function getAffiliates(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['userid', 'visitors', 'paytype', 'payamount', 'onetime', 'balance', 'withdrawn']);

        return $this->send('GetAffiliates', $resolver->resolve($parameters));
    }
}
