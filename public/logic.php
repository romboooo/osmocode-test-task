<?php
    function parseLine(string $line): array{
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

            $prefix = substr($line,0,  $openBracketPosition);
            $body   = substr($line, $openBracketPosition + 1, $closeBracketPosition - $openBracketPosition - 1);
            $postfix = substr($line, $closeBracketPosition + 1);

            $variants = splitByColon($body);

            foreach ($variants as $curr){
                $newLine = $prefix . $curr . $postfix;
                $output_array = array_merge($output_array, parseLine($newLine));
            }

            return $output_array;
        }
    function splitByColon($body):array{
        $output_array = [];

        $current = '';
        $enclosureCounter = 0;
    
        $pointer = 0;
        while($pointer < strlen($body)){
            if($body[$pointer] === '<'){
                $enclosureCounter++;
                $current .= $body[$pointer]; //самая удобная конкатенация в моей жизни 10/10 bless

            }
            else if ($body[$pointer] === '>') {
                $enclosureCounter--;
                $current .= $body[$pointer];
            }
            else if ($body[$pointer] === ':' && substr($body, $pointer, 2) === '::' && $enclosureCounter === 0){
                $output_array[] = $current;    
                $current = '';
                $pointer++;            
            }
            else{
                 $current .= $body[$pointer];
            }
            $pointer++;
        }
        $output_array[] = $current;

        return $output_array;
    }

    
