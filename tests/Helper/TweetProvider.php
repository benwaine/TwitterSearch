<?php
namespace TwitterSearch\Search\Helper;

/**
 * Provides pre-captured json representations of tweets gathered from Twitter.
 *
 * @package    TwitterSearch
 * @subpackage Twitter
 * @author     Ben Waine <ben@ben-waine.co.uk>
 */
class TweetProvider
{
    public static function getFixture($name)
    {
        $path = __dir__ . '/../Fixtures/' . $name;

        if(!\file_exists($path))
        {
            throw new \InvalidArgumentException('Invalid Fixture File: ' . $name . ' Specified');
        }

        $json = \file_get_contents($path);

        return $json;

    }
}

