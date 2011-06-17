<?php
namespace TwitterSearch\Search;
use \Zend_Http_Client as Http;

/**
 * Description of Client
 *
 * @package    TwitterSearch
 * @subpackage Search
 * @author     Ben Waine <ben@ben-waine.co.uk>
 */
class Client
{
    /**
     * Initializes an instance of TwitterSearch\Search\Client.
     *
     * @param Zend_Http_Client $client Used to make outgoing calls to Twitter.
     */
    public function __construct(Http $client)
    {
        
    }

    public function getTweets()
    {

    }

    
}

