<?php
function codein_hex_encode($str){
    $str = str_split($str);
    $out = "";
    foreach($str as $st){
        $out .= "\\x".dechex(ord($st));
    }
    return $out;
}

function get_char($code, $i){
    return substr($code, $i, 1);
}

function preg_replaces($code) {
    $patterns = [
        "#\/\/(.*)\n#U",
        "/\r|\n/",
        "#<\?php#"
    ];

    $replace = [
        "",
        "",
        "<?php "
    ];

    return preg_replace($patterns, $replace, $code);
}
function encode_str($code){
    $i = 0;
    $res = "";
    $php = -1;
    $str = -1;
    $len = strlen($code);
    $html = -1;
    $script = -1;
    $o_funcs = array();
    while($i < $len){
        $char = substr($code, $i, 1);
        if ($char == "<" && ($char.get_char($code, $i+1).get_char($code, $i+2).get_char($code, $i+3).get_char($code, $i+4) == "<?php" || $char.get_char($code, $i+1).get_char($code, $i+2) == "<?=")) {
            $php = $i + 5;
            if ($html > 0) {
                $hex = '<?php echo "'.codein_hex_encode(substr($code, $html, $i - $html)).'";?>';
                $code = substr($code, 0, $html).$hex.substr($code, $i, $len);
                $html = -1;
                $i += strlen($hex) - (2 + (substr_count($hex, "\\")));
                $len = strlen($code);
            }
        }

        if (get_char($code, $i-1) != '\\' && get_char($code, $i+1) != '"' && $char == "$" && get_char($code, $str) == '"' && $php > 0 && $str > 0 && $script <= 0) {
            $cnt = $i + 1;
            while(preg_match("#[a-zA-Z0-9\-_>]#", get_char($code, $cnt))) {
                $cnt += 1;
            }
            $text = '" .'.substr($code, $i, $cnt - $i).(get_char($code, $cnt) != '"' ? '."' : "");
            $code = substr($code, 0, $i).$text.substr($code, $cnt + (get_char($code, $cnt) == '"' ? 1 : 0), $len);
            $i -= 6;
            $len = strlen($code);
        }

        if ($char == "<" && substr($code, $i, 8) == "<script>") {
            $script = $i;
        }

        if ($char == "<" && substr($code, $i, 9) == "</script>") {
            $script = -1;
        }

        if (($char == "'" || $char == '"') && $php > 0) {
            if ($str == -1) {
                $str = $i;
            } else if ($str > 0 && get_char($code, $str) == $char && $i - $str > 1 && !(get_char($code, $i-1) == "\\" && get_char($code, $i-2) != "\\")) {
                $str += 1;
                $text = substr($code, $str, $i - $str);
                if (substr($text, 0, 2) == "\\\\") {
                    $text = substr($text, 1);
                }
                $hex = '"'.codein_hex_encode($text).'"';
                $code = substr($code, 0, $str-1).$hex.substr($code, $i+1, $len);
                $str = -1;
                $i += strlen($hex) - (2 + (substr_count($hex, "\\")));
                $len = strlen($code);
            } else if (get_char($code, $str) == $char && $i - $str <= 1) {
                $str = -1;
            }
        }

        if ($char == "?" && get_char($code, $i+1) == ">") {
            $php = -1;
            $html = $i + 2;
        }

        $i += 1;
    }

    preg_match_all("#([A-Za-z_]+)\(#mU", $code, $exfuncs);
    $funcs = $exfuncs[1];
    $not = array("function");
    $befs = array(" ", ".", "(");

    foreach($funcs as $func){
        if (!in_array($func, $not) && function_exists($func)) {
            if (!array_key_exists($func, $o_funcs)) {
                $mdfunc = md5($func);
                $cnt = 0;
                while(preg_match("#[0-9]#", substr($mdfunc, $cnt, 1))) {
                    $cnt += 1;
                }
                $mdfunc = substr($mdfunc, $cnt);
                $strenc = '$GLOBALS["'.$mdfunc.'"]="'.codein_hex_encode($func).'";';
                $code = substr($code, 0, 5).$strenc.substr($code, 5);
                $o_funcs[$func] = $mdfunc;
            }
            $pos = 0;
            while($pos < $len){
                $text = strpos($code, $func, $pos);
                $posfunc = strpos($code, "function ".$func, $pos) + strlen($func);
                if ($text && ($posfunc < $text || $posfunc < 0)) {
                    $bef = substr($code, $text-1, 1);
                    $aft = substr($code, $text+strlen($func), 1);
                    if (in_array($bef, $befs) && $aft == "(") {
                        $encfunc = '$GLOBALS["'.$o_funcs[$func].'"]';
                        $code = substr($code, 0, $text).$encfunc.substr($code, $text+strlen($func));
                    }
                }
                $pos += $text + strlen($func) + 1;
            }
        }
    }
    $code = preg_replaces($code);
//     $comment = "/**\n" .
// "* Obf.ThanhDieu.Com Online Obfuscation PHP:)\n" .
//     "* Obfuscate At: ".date("H:i:s d/m/Y")."\n" .
//     "* Option: String Encode - Compressor\n" .
//     "* Signature: ".md5(rand(1,99999))."\n" .
//     "*/\n";
    return $code;
}