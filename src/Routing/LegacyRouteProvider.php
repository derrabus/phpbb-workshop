<?php

namespace App\Routing;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class LegacyRouteProvider
{
    private $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    public function getRouteCollection(): RouteCollection
    {
        $finder = new Finder();
        $finder->files()->name('*.php');
        $collection = new RouteCollection();

        $collection->add(
            'legacy_home',
            new Route(
                '/',
                [
                    'legacyScript' => $this->projectDir.'/scripts/index.php',
                    'PHP_SELF' => 'index.php',
                ]
            )
        );

        /** @var SplFileInfo $file */
        foreach ($finder->in($this->projectDir.'/scripts') as $file) {
            $collection->add(
                'legacy.'.str_replace('/', '__', substr($file->getRelativePathname(), 0, -4)),
                new Route(
                    $file->getRelativePathname(),
                    [
                        'legacyScript' => $file->getPathname(),
                        'PHP_SELF' => $file->getRelativePathname(),
                    ]
                )
            );
        }

        return $collection;
    }
}
