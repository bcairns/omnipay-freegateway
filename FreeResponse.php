<?php
/**
 * Response interface
 */

namespace Omnipay\FreeGateway;

use Omnipay\Common\Message;

/**
 * Response Interface
 *
 * This interface class defines the standard functions that any Omnipay response
 * interface needs to be able to provide.  It is an extension of MessageInterface.
 *
 * @see MessageInterface
 */
class FreeResponse implements ResponseInterface
{
	var $request;

	public function __construct(RequestInterface $request)
	{
		$this->request = $request;
	}

	/**
     * Get the original request which generated this response
     *
     * @return RequestInterface
     */
	public function getRequest(){
		return $this->request;
	}

	/**
     * Is the response successful?
     *
     * @return boolean
     */
	public function isSuccessful(){
		return true;
	}

	/**
     * Does the response require a redirect?
     *
     * @return boolean
     */
	public function isRedirect(){
		return false;
	}

	/**
     * Is the transaction cancelled by the user?
     *
     * @return boolean
     */
	public function isCancelled(){
		return false;
	}

	/**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
	public function getMessage(){
		return null;
	}

	/**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
	public function getCode(){
		return null;
	}

	/**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
	public function getTransactionReference(){
		return null;
	}

}
