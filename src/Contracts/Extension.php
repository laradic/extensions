<?php
/**
 * Part of the Radic packages.
 */
namespace Laradic\Extensions\Contracts;

/**
 * Class Extension
 *
 * @package     Laradic\Extensions\Contracts
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
interface Extension
{

    /**
     * Returns an array with slug, namespace, version and dependencies
     *
     * @return array
     */
    public static function getInfo();
}
