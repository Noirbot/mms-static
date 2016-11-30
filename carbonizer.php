<?php

$iterator = new DirectoryIterator(__DIR__ . '/templates');

function isValidFile(SplFileInfo $fileInfo)
{
    return $fileInfo->isFile()
        && 'php' === $fileInfo->getExtension()
        && basename(__FILE__) !== $fileInfo->getBasename();
}

function parseFile(SplFileInfo $fileInfo)
{
    ob_start();
    require_once 'templates/' . $fileInfo->getBasename();
    $data = ob_get_contents();
    ob_end_clean();

    return $data;
}

foreach ($iterator as $fileInfo) {
    if (isValidFile($fileInfo)) {
        $data = parseFile($fileInfo);
        $file = 'built/' . $fileInfo->getBasename('.php') . '.html';
        file_put_contents($file, $data);
    }
}

?>
