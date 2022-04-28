<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Addons extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/updateclientaddon/
     */
    public function updateClientAddon(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'id', 'status', 'addonid', 'name', 'setupfee', 'recurring', 'billingcycle',
            'nextduedate', 'terminationdate', 'notes', 'autorecalc',
        ]);
        $resolver->setAllowedTypes('id', 'int');
        $resolver->setAllowedTypes('setupfee', 'float‚');
        $resolver->setAllowedTypes('recurring', 'float‚');
        $resolver->setAllowedValues('status', self::STATUS_PRODUCT);

        $resolver->setRequired('id');

        return $this->send('UpdateClientAddon', $resolver->resolve($parameters));
    }
}
