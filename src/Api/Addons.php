<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Addons extends AbstractApi
{
    public function updateClientAddon(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setRequired('id');

        return $this->send('UpdateClientAddon', $resolver->resolve($parameters));
    }
}
