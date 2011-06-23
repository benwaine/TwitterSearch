<?php
namespace TwitterSearch\Search;
use \Zend_Http_Client as Http;
use \Zend_Http_Response as HttpResp;

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
     * Http Client - Used for making requests to the Twitter API.
     *
     * @var \Zend_Http_Client
     */
    private $client;

    /**
     * Desired language of the tweets returned.
     *
     * @var string
     */
    private $lang;

    /**
     * Desired result type of the tweets returned.
     *
     * @var string
     */
    private $resultType;


    /**
     * The uri of the search endpoint provided by Twitter.
     *
     * @var string
     */
    const TWITTER_SEARCH_ENDPOINT = 'http://search.twitter.com/search.json';

    /**
     * Constant defines the 'mixed' result type. (Mix of popular and recent tweets).
     *
     * @var string
     */
    const RESULT_TYPE_MIXED = 'mixed';

    /**
     * Constant defines the maximum results per page.
     *
     * @var integer
     */
    const RPP = 100;

    /**
     * Constant defines the 'recent' result type. (Only recent tweets).
     *
     * @var string
     */
    const RESULT_TYPE_RECENT = 'recent';

    /**
     * Constant defines the 'popular' result type. (Only popular tweets).
     *
     * @var string
     */
    const RESULT_TYPE_POPULAR = 'popular';

    /**
     * Initializes an instance of TwitterSearch\Search\Client.
     *
     * @param Zend_Http_Client $client Used to make outgoing calls to Twitter.
     */
    public function __construct(Http $client)
    {
        $this->client = $client;
    }

    /**
     * Sets the desired language of the returned tweets.
     *
     * @param string $lang Language code (iso 639-1)
     *
     * @return void
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Sets the desired result type to be returned. 
     * Twitter can return popular tweets or recent tweets only, or a mix of the tweets.
     *
     * @param string $resultType One of the predefined result constants.
     *
     * @return void
     */
    public function setResultType($resultType)
    {
        $this->resultType = $resultType;
    }

    /**
     * Query Twitter for the amount of tweets containing the keyword.
     *
     * @param string  $keyword Keyword must be present in returned tweets.
     * @param integer $amount  Amount of tweets required.
     *
     * @return array
     */
    public function getTweets(array $keyword, $amount = 10)
    {

        // Pages required
        $pagesReq = $amount / self::RPP;

        for($page=1; $page <= $pagesReq; $page++)
        {
            $url = $this->constructUrl($keyword, $page);

            $this->queryTwitter($url);
        }


    }

    /**
     * Constructs a URL used to query Twitter with.
     *
     * @param string  $keyword Keyword to query Twitter with.
     * @param integer $page    Page number - (1 - 15) used to access pages in result resource
     *
     * @return string
     */
    protected function constructUrl(array $keyword, $page)
    {
        $queryStringStart = '?';

        $params['q'] = $keyword;
        $params['page'] = $page;
        $params['rpp'] = self::RPP;

        if(isset($this->lang))
        {
            $params['lang'] = $this->lang;
        }

        if(isset($this->resultType))
        {
            $params['result_type'] = $this->resultType;
        }

        $queryString = '';

        foreach($params as $key => $param)
        {
            if(is_array($param))
            {
                $paraStr = '';

                foreach($param as $p)
                {
                    $paraStr .= \urlencode($p) . '+';
                }

                $paraStr = substr($paraStr, 0, -1);

                $queryString .= $key . '=' . $paraStr . '&';
            }
            else
            {
                $queryString .= $key . '=' . \urlencode($param) . '&';
            }

           
        }

        $queryString = \substr($queryString, 0, -1);

        $url = self::TWITTER_SEARCH_ENDPOINT . $queryStringStart . $queryString;

        return $url;
    }

    /**
     * Uses HTTP to query Twitter for tweets with the specified URL.
     *
     * @param string $url URL to query Twitter with
     *
     * @return array
     */
    protected function queryTwitter($url)
    {
        $this->client->setUri($url);

        $response = $this->client->request();
    }

    /**
     * Handels the response from Twitter.
     *
     * @param HttpResp $httpResp
     *
     * @return array
     */
    protected function handleQueryResult(HttpResp $httpResp)
    {
        
    }

}

