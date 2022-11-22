<?php
function SQLi_Whitelist($data)
{
        $errSqli ="";
        $pattern = '(^[\w|\d|@|!|#|$]*$)';
        if (!preg_match($pattern, $data)) {
                $errSqli = "Login fail!";
        }
        return $errSqli;
}
function SQLfilter($valor)
{
        $data = array(
                " ", "'", "' or 1=1#", "' or 1=1- -", "' or 1=1/*", "' or 1=1;%00",
                 "' or 1=1 union select 1,2 as `", "1='1", "' /*!50000or*/1='1", "' /*!or*/1='1",
                 "+", "-","~","!","^","=","%","/","*","&&","&","|","||",">>","<=",">=",",","XOR","DIV",
                 "LIKE","SOUNDS","RLIKE","REGEXP","LEAST","GREATEST","CAST","CONVERT","IS","IN","NOT"
                 ,"MATCH","AND","OR","BINARY","BETWEEN","ISNULL","%20","%09","%0a","%0b","%0c","%0d","%a0"
                 ,"SELECT","COPY","DELETE","DROP","DUMP","--","[","]","\\","?","SLEEP","UNION","LIMIT","WHERE"
                 ,"GROUP","HAVING","SUBSTR"
                );
        foreach ($data as $value) {
                    if (str_contains($valor, $value) == true) {
                        $valor = "";
                }
        }
        return $valor;
}
function xss_clean($data)
{
        // Fix &entity\n;
        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        // $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        // $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        // $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);

        return $data;
}
