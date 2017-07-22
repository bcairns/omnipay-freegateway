<?php

class CheckoutPage_Controller_Extension extends Extension{

	public function updateConfirmationForm( $form ){
		$submit = $form->Actions()->fieldByName( 'action_checkoutSubmit' );
		$order = ShoppingCart::curr();
		if( $order && $order->GrandTotal() <= 0 ){
			$submit->setTitle( 'Complete Your Free Order!' );
		}
	}

}
