<?php
function readData(): string
{
    return readline();
}
function parseLine(string $line): array
{
    if (!str_contains($line, "<")) {
        return [$line];
    }
    $output_array = [];

    $openBracketPosition = strpos($line, "<");
    $enclosureCounter = 0;
    $closeBracketPosition = -200;

    for ($i = $openBracketPosition; $i < strlen($line); ++$i) {
        
        if ($line[$i] === '<') {
            $enclosureCounter++;
        } else if ($line[$i] === '>') {
            $enclosureCounter--;
        }

        if ($enclosureCounter === 0) {
            $closeBracketPosition = $i;
            break;
        }
    }

    if ( $closeBracketPosition == -200){
        echo "syntax Error: there aren't closure bracket '>'";
        return ['err'];
    }


    return $output_array;
}

function findCloseBracket($openBracketPosition, $line): int
{




    return 0;
}

$res = parseLine(readData())[0];
echo $res;
