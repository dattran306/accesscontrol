<?php
$url = file_get_contents("https://vltkn.csb.app/");



preg_match_all("/security/",
                $url);

                
?>