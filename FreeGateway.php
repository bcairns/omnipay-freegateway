<?php

/**
 * Free Gateway.
 */
namespace Omnipay\FreeGateway;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway{

	public function getName()
	{
		return 'Free! (No Purchase Required)';
	}

	/**
     * Purchase request.
     * @param array $parameters
     * @return \Omnipay\Stripe\Message\PurchaseRequest
     */
	public function purchase(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\FreeGateway\FreeRequest', $parameters);
	}


}
