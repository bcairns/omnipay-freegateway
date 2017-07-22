<?php
/**
 * Request Interface
 */

namespace Omnipay\FreeGateway;

use Omnipay\Common\Message;


/**
 * Request Interface
 *
 * This interface class defines the standard functions that any Omnipay request
 * interface needs to be able to provide.  It is an extension of MessageInterface.
 *
 * @see MessageInterface
 */
class FreeRequest implements RequestInterface
{
	var $response;
	var $params;

	/**
     * Initialize request with parameters
     * @param array $parameters The parameters to send
     */
	public function initialize(array $parameters = array()){
		$this->params = $parameters;
		$this->response = new FreeResponse($this);
	}

	/**
     * Get all request parameters
     *
     * @return array
     */
	public function getParameters(){
		return $this->params;
	}

	/**
     * Get the response to this request (if the request has been sent)
     *
     * @return ResponseInterface
     */
	public function getResponse(){
		return $this->response;
	}

	/**
     * Send the request
     *
     * @return ResponseInterface
     */
	public function send(){
		return $this->response;
	}

	/**
     * Send the request with specified data
     *
     * @param  mixed             $data The data to send
     * @return ResponseInterface
     */
	public function sendData($data){
		return $this->response;
	}
}
