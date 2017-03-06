<?php

namespace Installers;

use Composer\Factory;
use Composer\Json;
use Composer\Script\Event;
use Composer\Util;

class ProjectInstaller
{

    protected static $jsonNodes = [
        'name',
        'description',
        'license',
        'type',
        'scripts',
    ];

    protected static $jsonContents = [
        'autoload' => 'psr-4',
    ];

    protected static $deleteFiles = [
        '.gitignore',
        'LICENSE',
        'README.md',
        'src/Entities/.gitkeep',
        'src/Repositories/.gitkeep',
    ];

    public static function postCreate(Event $event)
    {
        $fs = new Util\Filesystem();

        $file = Factory::getComposerFile();
        $json = new Json\JsonFile($file);
        $contents = self::unsetJsonNodes($json, static::$jsonNodes);
        $contents = self::manipulateJsonContents($contents, static::$jsonContents);
        file_put_contents($json->getPath(), $contents);

        $projectDir = realpath(".");
        self::deleteFiles($fs, $projectDir, self::$deleteFiles);

        $installersDir = dirname(realpath(__FILE__));
        $fs->remove($installersDir);
    }

    protected static function unsetJsonNodes($json, $nodes)
    {
        $data = $json->read();

        foreach ($nodes as $node) {
            unset($data[$node]);
        }

        return Json\JsonFile::encode($data);
    }

    protected static function manipulateJsonContents($contents, $removeContents)
    {
        $manipulator = new Json\JsonManipulator($contents);

        foreach ($removeContents as $node => $remove) {
            foreach ((array)$remove as $name) {
                $manipulator->removeSubNode($node, $name);
            }
        }

        return $manipulator->getContents();
    }

    protected static function deleteFiles($fs, $dir, $files)
    {
        foreach ($files as $file) {
            $fs->remove($dir . '/' . $file);
        }
    }
}
