<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Products extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/addproduct/
     */
    public function addProduct(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'name', 'gid', 'slug', 'type', 'stockcontrol', 'qty', 'paytype', 'hidden', 'showdomainoptions',
            'tax', 'isFeatured', 'proratabilling', 'description', 'shortdescription', 'tagline', 'color',
            'welcomeemail', 'proratadate', 'proratachargenextmonth', 'subdomain', 'autosetup', 'module', 'servergroupid',
            'configoption1', 'configoption2', 'configoption3', 'configoption4', 'configoption5', 'configoption6',
            'order', 'pricing', 'recommendations',
        ]);
        $resolver->setAllowedTypes('name', 'string');
        $resolver->setAllowedTypes('gid', 'int');
        $resolver->setRequired(['name', 'gid']);

        return $this->send('AddProduct', $resolver->resolve($parameters));
    }
}
