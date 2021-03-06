<?php
 /**
 * Part of the Radic packages.
 */
namespace Laradic\Extensions\Console;

use Laradic\Console\Command;
use Laradic\Support\String;

/**
 * Class ListExtensionsCommand
 *
 * @package     Laradic\Extensions\Console
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
class ListExtensionsCommand extends Command
{
    protected $name = 'extensions:list';
    protected $description = 'List all local extensions';

    public function fire()
    {
        $extensions = app('extensions');

        $rows = [];
        foreach($extensions->all() as $extension)
        {
            /** @var \Laradic\Extensions\Extension $extension */
            $rows[] = [
                $extension->getName(),
                $extension->getSlug(),
                $extension->getVersion()->valid(),
                (string) String::removeLeft($extension->getPath(), base_path().'/'),
                $extension->isInstalled() ? $this->colorize('green', 'Y') : $this->colorize('yellow', 'N')
            ];
        }

        $this->table(['Name', 'Slug', 'Version', 'Path', 'Installed'], $rows);

    }
}
