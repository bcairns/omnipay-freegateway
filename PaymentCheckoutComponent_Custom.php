<?php

class PaymentCheckoutComponent_Custom extends PaymentCheckoutComponent
{
	public function getFormFields(Order $order)
	{
		$fields = parent::getFormFields( $order );

		// disable unavailable payment options (free vs non-free)
		$paymentOptions = $fields->fieldByName('PaymentMethod');
		if( $paymentOptions && $paymentOptions->Type() == 'optionset' ){
			$order = ShoppingCart::curr();
			if( $order ){
				if( $order->GrandTotal() > 0 ){
					// remove free option entirely
					$options = $paymentOptions->getSource();
					unset( $options['FreeGateway'] );
					$paymentOptions->setSource( $options );
				}else{
					// disable everything except the free option, and set it to be selected
					$options = $paymentOptions->getSource();
					unset( $options['FreeGateway'] );
					$paymentOptions->setDisabledItems( array_keys($options) );
					$paymentOptions->setValue( 'FreeGateway' );
				}
			}
		}

		return $fields;
	}

	public function validateData(Order $order, array $data)
	{

		parent::validateData( $order, $data );

		// validate they aren't selecting Free payment for a non-free order (and vice versa)
		$order = ShoppingCart::curr();
		if( $order ){
			// either the order total must be greater than zero, OR freegateway must be selected, but not both (xor)
			if( !( $order->GrandTotal() > 0 xor $data['PaymentMethod'] == 'FreeGateway' ) ){
				$result = ValidationResult::create();
				$result->error(_t('PaymentCheckoutComponent.UnavailableGateway', "This payment method is not available."), "PaymentMethod");
				throw new ValidationException($result);
			}
		}

	}


}
