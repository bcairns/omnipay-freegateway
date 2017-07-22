<?php

class CheckoutStep_PaymentMethod_Custom extends CheckoutStep_PaymentMethod{
	private static $allowed_actions = array(
		'paymentmethod',
		'PaymentMethodForm',
	);

	protected function checkoutconfig()
	{
		$config = new CheckoutComponentConfig(ShoppingCart::curr(), false);
		$config->addComponent(PaymentCheckoutComponent_Custom::create());

		return $config;
	}
}
