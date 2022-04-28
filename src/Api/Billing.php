<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Billing extends AbstractApi
{
    /**
     * @see https://developers.whmcs.com/api-reference/acceptquote/
     */
    public function acceptQuote(int $quoteId)
    {
        return $this->send('AcceptQuote', ['quoteid' => $quoteId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/addbillableitem/
     */
    public function addBillableItem(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'clientid', 'description', 'amount', 'unit', 'quantity', 'invoiceaction', 'recur',
            'recurcycle', 'recurfor', 'duedate'
        ]);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('description', 'string');
        $resolver->setAllowedTypes('amount', 'float');
        $resolver->setAllowedValues('unit', ['hours', 'quantity']);
        $resolver->setAllowedValues('invoiceaction', ['noinvoice', 'nextcron', 'nextinvoice', 'duedate', 'recur']);
        $resolver->setAllowedValues('recurcycle', ['Days', 'Weeks', 'Months', 'Years']);
        $resolver->setRequired(['clientid', 'description', 'amount', 'unit']);

        return $this->send('AddBillableItem', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/addcredit/
     */
    public function addCredit(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['clientid', 'description', 'amount', 'date', 'adminid', 'type']);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('description', 'string');
        $resolver->setAllowedTypes('amount', 'float');
        $resolver->setRequired(['clientid', 'description', 'amount']);

        return $this->send('AddCredit', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/addinvoicepayment/
     */
    public function addInvoicePayment(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['invoiceid', 'transid', 'gateway', 'date', 'amount', 'fees', 'noemail']);
        $resolver->setAllowedTypes('invoiceid', 'int');
        $resolver->setAllowedTypes('transid', 'string');
        $resolver->setAllowedTypes('gateway', 'string');
        $resolver->setRequired(['invoiceid', 'transid', 'gateway', 'date']);

        return $this->send('AddInvoicePayment', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/addpaymethod/
     */
    public function addPayMethod(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'clientid', 'type', 'description', 'gateway_module_name', 'card_number', 'card_expiry', 'card_start',
            'card_issue_number', 'bank_name', 'bank_account_type', 'bank_code', 'bank_account', 'set_as_default'
        ]);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setRequired(['clientid']);

        return $this->send('AddPayMethod', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/addtransaction/
     */
    public function addTransaction(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'paymentmethod', 'userid', 'invoiceid', 'transid', 'date', 'currencyid', 'description', 'amountin', 'fees',
            'amountout', 'rate', 'credit', 'allowduplicatetransid'
        ]);
        $resolver->setAllowedTypes('paymentmethod', 'string');
        $resolver->setAllowedTypes('userid', 'int');
        $resolver->setAllowedTypes('invoiceid', 'int');
        $resolver->setAllowedTypes('transid', 'string');
        $resolver->setRequired(['paymentmethod']);

        return $this->send('AddTransaction', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/applycredit/
     */
    public function applyCredit(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['invoiceid', 'amount', 'noemail']);
        $resolver->setAllowedTypes('invoiceid', 'int');
        $resolver->setAllowedTypes('amount', 'float');
        $resolver->setAllowedTypes('noemail', 'bool');
        $resolver->setRequired(['invoiceid']);

        return $this->send('ApplyCredit', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/capturepayment/
     */
    public function capturePayment(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['invoiceid', 'cvv']);
        $resolver->setAllowedTypes('invoiceid', 'int');
        $resolver->setAllowedTypes('cvv', 'string');
        $resolver->setRequired(['invoiceid']);

        return $this->send('CapturePayment', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/createinvoice/
     */
    public function createInvoice(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'userid', 'status', 'draft', 'sendinvoice', 'paymentmethod', 'taxrate', 'taxrate2', 'date',
            'duedate', 'notes', 'itemdescriptionx', 'itemamountx', 'itemtaxedx', 'autoapplycredit'
        ]);
        $resolver->setAllowedTypes('userid', 'int');
        $resolver->setAllowedTypes('status', 'string');
        $resolver->setAllowedTypes('draft', 'bool');
        $resolver->setAllowedTypes('sendinvoice', 'bool');
        $resolver->setAllowedTypes('paymentmethod', 'string');
        $resolver->setAllowedTypes('taxrate', 'float');
        $resolver->setAllowedTypes('taxrate2', 'float');
        $resolver->setAllowedTypes('date', 'string');
        $resolver->setAllowedTypes('duedate', 'string');
        $resolver->setAllowedTypes('notes', 'string');
        $resolver->setAllowedTypes('itemdescriptionx', 'string');
        $resolver->setAllowedTypes('itemamountx', 'float');
        $resolver->setAllowedTypes('itemtaxedx', 'bool');
        $resolver->setAllowedTypes('autoapplycredit', 'bool');
        $resolver->setRequired(['userid']);

        return $this->send('CreateInvoice', $this->createOptionsResolver()->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/createquote/
     */
    public function createQuote(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'subject', 'stage', 'validuntil', 'datecreated', 'lineitems', 'userid', 'firstname', 'lastname',
            'companyname', 'email', 'address1', 'address2', 'city', 'state', 'postcode', 'country', 'phonenumber',
            'tax_id', 'currency', 'proposal', 'customernotes', 'adminnotes',
        ]);
        $resolver->setAllowedValues('stage', self::STATUS_BILLINGSTAGE);
        $resolver->setRequired(['subject', 'stage', 'validuntil']);

        return $this->send('CreateQuote', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/deletepaymethod/
     */
    public function deletePayMethod(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['clientid', 'paymethodid', 'failonremotefailure']);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('paymethodid', 'int');
        $resolver->setRequired(['clientid', 'paymethodid']);

        return $this->send('DeletePayMethod', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/deletequote/
     */
    public function deleteQuote(int $quoteId)
    {
        return $this->send('DeleteQuote', ['quoteid' => $quoteId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/geninvoices/
     */
    public function genInvoices(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['noemails', 'clientid', 'serviceids', 'domainids', 'addonids']);
        $resolver->setAllowedTypes('noemails', 'bool');
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('serviceids', 'int[]');
        $resolver->setAllowedTypes('domainids', 'int[]');
        $resolver->setAllowedTypes('addonids', 'int[]');

        return $this->send('GenInvoices', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getcredits/
     */
    public function getCredits(int $clientId)
    {
        return $this->send('GetCredits', ['clientid' => $clientId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getinvoice/
     */
    public function getInvoice(int $invoiceId)
    {
        return $this->send('GetInvoice', ['invoiceid' => $invoiceId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getinvoices/
     */
    public function getInvoices(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['userid', 'status']);
        $resolver->setAllowedTypes('userid', 'int');
        $resolver->setAllowedValues('status', self::STATUS_INVOICE);

        return $this->send('GetInvoices', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getpaymethods/
     */
    public function getPayMethods(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['clientid', 'paymethodid', 'type']);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('paymethodid', 'int');
        $resolver->setRequired(['clientid']);

        return $this->send('GetPayMethods', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/getquotes/
     */
    public function getQuotes(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['quoteid', 'userid', 'subject', 'stage', 'datecreated', 'lastmodified', 'validuntil']);
        $resolver->setAllowedTypes('quoteid', 'int');
        $resolver->setAllowedTypes('userid', 'int');
        $resolver->setAllowedTypes('subject', 'string');
        $resolver->setAllowedValues('stage', self::STATUS_BILLINGSTAGE);
        $resolver->setAllowedTypes('datecreated', 'string');
        $resolver->setAllowedTypes('lastmodified', 'string');
        $resolver->setAllowedTypes('validuntil', 'string');

        return $this->send('GetQuotes', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/gettransactions/
     */
    public function getTransactions(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['invoiceid', 'clientid', 'transid']);
        $resolver->setAllowedTypes('invoiceid', 'int');
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('transid', 'string');

        return $this->send('GetTransactions', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/sendquote/
     */
    public function sendQuote(int $quoteId)
    {
        return $this->send('SendQuote', ['quoteid' => $quoteId]);
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updateinvoice/
     */
    public function updateInvoice(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'invoiceid', 'status', 'paymentmethod', 'taxrate', 'taxrate2', 'credit', 'date', 'duedate', 'datepaid',
            'notes', 'itemdescription', 'itemamount', 'itemtaxed', 'newitemdescription', 'newitemamount',
            'newitemtaxed', 'deletelineids', 'publish', 'publishandsendemail',
        ]);
        $resolver->setAllowedTypes('invoiceid', 'int');
        $resolver->setAllowedTypes('itemdescription', 'string[]');
        $resolver->setAllowedTypes('itemamount', 'float[]');
        $resolver->setAllowedTypes('itemtaxed', 'bool[]');
        $resolver->setAllowedTypes('newitemdescription', 'string[]');
        $resolver->setAllowedTypes('newitemamount', 'float[]');
        $resolver->setAllowedTypes('newitemtaxed', 'bool[]');
        $resolver->setAllowedTypes('deletelineids', 'int[]');
        $resolver->setAllowedValues('status', self::STATUS_ORDER);
        $resolver->setRequired(['invoiceid']);

        return $this->send('UpdateInvoice', $this->createOptionsResolver()->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updatepaymethod/
     */
    public function updatePayMethod(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'clientid', 'paymethodid', 'card_number', 'card_expiry', 'card_start', 'card_issue_number', 'bank_name',
            'bank_account_type', 'bank_code', 'bank_account', 'set_as_default',
        ]);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('paymethodid', 'int');
        $resolver->setRequired(['clientid', 'paymethodid']);

        return $this->send('UpdatePayMethod', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updatequote/
     */
    public function updateQuote(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'quoteid', 'subject', 'stage', 'validuntil', 'datecreated', 'lineitems', 'userid', 'firstname', 'lastname',
            'companyname', 'email', 'address1', 'address2', 'city', 'state', 'country', 'phonenumber', 'tax_id',
            'currency', 'proposal', 'customernotes', 'adminnotes'
        ]);
        $resolver->setAllowedTypes('quoteid', 'int');
        $resolver->setAllowedValues('stage', self::STATUS_BILLINGSTAGE);
        $resolver->setRequired(['quoteid']);

        return $this->send('UpdateQuote', $resolver->resolve($parameters));
    }

    /**
     * @see https://developers.whmcs.com/api-reference/updatetransaction/
     */
    public function updateTransaction(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined([
            'transactionid', 'refundid', 'userid', 'invoiceid', 'transid', 'date', 'gateway',
            'currency', 'description', 'amountin', 'fees', 'amountout', 'rate', 'credit'
        ]);
        $resolver->setAllowedTypes('transactionid', 'int');
        $resolver->setAllowedTypes('refundid', 'int');
        $resolver->setAllowedTypes('userid', 'int');
        $resolver->setAllowedTypes('invoiceid', 'int');
        $resolver->setRequired(['transactionid']);

        return $this->send('UpdateTransaction', $resolver->resolve($parameters));
    }
}
