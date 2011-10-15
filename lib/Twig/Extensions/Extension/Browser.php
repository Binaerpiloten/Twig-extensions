<?php

/**
 * This file is part of Twig.
 *
 * (c) 2011 Nils Wisiol
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nils Wisiol <mail@nils-wsiol.de>
 */
class Twig_Extensions_Extension_Browser extends Twig_Extension
{
    /**
     * Returns a list of filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return array('number' => new Twig_Filter_Function('twig_number_filter'));
    }
    
    public function getFunctions()
    {
    	return array('browser' => new Twig_Function_Function('twig_browser_function'));
    }

    /**
     * Name of this extension
     *
     * @return string
     */
    public function getName()
    {
        return 'Browser';
    }
}

function twig_browser_function($capability)
{
	$agent = $_SERVER['HTTP_USER_AGENT']; // TODO Gibt es hier ein Symfony-Interface?

	switch ($capability) {
		case 'css-fixed':
			if (preg_match('/ipad|ipod|iphone/i', $agent))
				return preg_match('/iphone os 5/i', $agent);
			else if (preg_match('/android/i', $agent))
				return true;
			else
				return true;			
		default:
			throw new InvalidArgumentException("Unknown user agent detection in twig function 'browser()': $capability");
	}
}
