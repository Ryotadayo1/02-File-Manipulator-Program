<?php

if ($argc < 2) {
    echo "Error: No command provided.\n";
    exit(1);
}

$command = $argv[1];

switch ($command) {
    case "reverse":
        if ($argc !== 4) {
            echo "Usage: php FileManipulator.php reverse inputpath outputpath\n";
            exit(1);
        }
        reverseFile($argv[2], $argv[3]);
        break;

    case "copy":
        if ($argc !== 4) {
            echo "Usage: php FileManipulator.php copy inputpath outputpath\n";
            exit(1);
        }
        copyFile($argv[2], $argv[3]);
        break;

    case "duplicate-contents":
        if ($argc !== 4 || !is_numeric($argv[3]) || (int)$argv[3] < 1) {
            echo "Usage: php FileManipulator.php duplicate-contents inputpath n\n";
            exit(1);
        }
        duplicateContents($argv[2], (int)$argv[3]);
        break;

    case "replace-string":
        if ($argc !== 5) {
            echo "Usage: php FileManipulator.php replace-string inputpath needle newstring\n";
            exit(1);
        }
        replaceString($argv[2], $argv[3], $argv[4]);
        break;

    default:
        echo "Error: Unknown command '$command'.\n";
        exit(1);
}

function reverseFile(string $inputPath, string $outputPath): void {
    if (!file_exists($inputPath)) {
        echo "Error: Input file not found.\n";
        exit(1);
    }
    $contents = file_get_contents($inputPath);
    $reversed = strrev($contents);
    file_put_contents($outputPath, $reversed);
    echo "File reversed and saved to $outputPath\n";
}

function copyFile(string $inputPath, string $outputPath): void {
    if (!file_exists($inputPath)) {
        echo "Error: Input file not found.\n";
        exit(1);
    }
    copy($inputPath, $outputPath);
    echo "File copied to $outputPath\n";
}

function duplicateContents(string $inputPath, int $times): void {
    if (!file_exists($inputPath)) {
        echo "Error: Input file not found.\n";
        exit(1);
    }
    $contents = file_get_contents($inputPath);
    $duplicated = str_repeat($contents, $times);
    file_put_contents($inputPath, $duplicated);
    echo "File contents duplicated $times times.\n";
}

function replaceString(string $inputPath, string $needle, string $newstring): void {
    if (!file_exists($inputPath)) {
        echo "Error: Input file not found.\n";
        exit(1);
    }
    $contents = file_get_contents($inputPath);
    $replaced = str_replace($needle, $newstring, $contents);
    file_put_contents($inputPath, $replaced);
    echo "All occurrences of '$needle' replaced with '$newstring'.\n";
}
