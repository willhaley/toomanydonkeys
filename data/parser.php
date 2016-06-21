<?php

$raw = file_get_contents('raw.html');
$parts = explode( "<tr>", $raw );

$data = array();

foreach ( $parts as $idx => $part ){

    $rows  = explode("<td", $part );

    $episode = array();

    foreach ( $rows as $row ){


        if ( ! $row ){
            continue;
        }

     //   print_r ( $row );

        if ( preg_match('/table\ c/', $row ) ){
            continue;
        }

        if ( preg_match('/style="text-align:right;">/', $row ) ){
            $episode['number'] = trim( preg_replace( '/<\/td>/', '', preg_replace( '/style="text-align:right;">/', '', $row ) ) );
        }

        if ( preg_match('/><a href="\/wiki\//', $row ) ){
            $episode['who'] = explode( ',', preg_replace('/\n|\ /', '', strip_tags( rtrim( '<td ' .  $row )  ) ));
        }

        if ( preg_match('/<i>/', $row ) ){
            $episode['title'] = preg_replace('/\n/', '', strip_tags( rtrim( '<td ' .  $row )  ) );
        }

        if ( preg_match('/font-size:75%;white-space/', $row ) ){
            $episode['date'] = preg_replace('/\n/', '', strip_tags( rtrim( '<td ' .  $row )  ) );
        }

        if ( preg_match('/background-color:LightPink/', $row ) ){
            $episode['outcome'] = preg_replace('/\n/', '', strip_tags( rtrim( '<td ' .  $row )  ) );
        }

        if ( preg_match('/class="external text exitstitial"/', $row ) ){

            $xml_string ='<td ' .  $row ;
            $xml_string = str_replace('<td  style="font-size:75%;text-align:center;">','', $xml_string);
            $xml_string = str_replace('</td>', '', $xml_string);
            $xml = simplexml_load_string($xml_string);
            //echo "$xml_string\n";
            $xml = (array ) $xml;
            print_r ( $xml );

            $episode['link'] = $xml['@attributes']['href'];
        }

    }
    $data[] = $episode;

}

file_put_contents('ep_list.json', json_encode($data));