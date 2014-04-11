<?php

function buildBaseString($baseURI, $method, $params) {
    $r = array();
    ksort($params);
    foreach($params as $key=>$value){
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

function returnTweet(){
    $oauth_access_token = "778525572-exiQcj6PM2J4G844QbPsWxFC5ldfo4E4TrDQb5RM";
    $oauth_access_token_secret = "iehLkxwSx3BpnAp8QDomcq8KfCUNbkxWOjeM9t8A";
    $consumer_key = "ndS4pdToZt0LMpeU64mSrA";
    $consumer_secret = "g50AP0jqaPFVZAZIWjox7QKhFgTAi54rjjKDUoLSA";

    $twitter_timeline           = "user_timeline";  //  mentions_timeline / user_timeline / home_timeline / retweets_of_me

    //  create request
        $request = array(
            'screen_name'       => 'envato',
            'count'             => '1'
        );

    $oauth = array(
        'oauth_consumer_key'        => $consumer_key,
        'oauth_nonce'               => time(),
        'oauth_signature_method'    => 'HMAC-SHA1',
        'oauth_token'               => $oauth_access_token,
        'oauth_timestamp'           => time(),
        'oauth_version'             => '1.0'
    );

    //  merge request and oauth to one array
        $oauth = array_merge($oauth, $request);

    //  do some magic
        $base_info              = buildBaseString("https://api.twitter.com/1.1/statuses/$twitter_timeline.json", 'GET', $oauth);
        $composite_key          = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
        $oauth_signature            = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature']   = $oauth_signature;

    //  make request
        $header = array(buildAuthorizationHeader($oauth), 'Expect:');
        $options = array( CURLOPT_HTTPHEADER => $header,
                          CURLOPT_HEADER => false,
                          CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_SSL_VERIFYPEER => false);

        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);

    return json_decode($json, true);
    
   
}
?>

<?php 


$mytweet = returnTweet();
$mytweettime = $mytweet[0]['created_at'];
$mytweetcreated = explode(" ", $mytweettime );
$mytweetcreatedfinal = implode(" ",array_splice($mytweetcreated,0,3));

?>

<style>
.twitter-<?php print $node->nid; ?>{
  background:url(<?php echo file_create_url($node->field_twitter_background_image['und'][0]['uri']); ?>);
  background-attachment:fixed;
  background-size:cover;
}
</style>

<div id="twitter" class="twitter-<?php print $node->nid; ?>" data-stellar-background-ratio="0.5">
	<div class="tint largepadding">
		<section class="row heading">
		<div class="ten columns centered">
			<!-- twitter icon -->
			<div class="main-icon">
				<i class="icon-twitter"></i>
			</div>
			<?php print $mytweetcreatedfinal; ?>
			<?php print $mytweet[0]["text"]; ?>
		</div>
		<!-- link to your twitter profile -->
		<a href="http://twitter.com/<?php print strip_tags(render($content['field_twitter_handle'])); ?>" class="rise-btn light small">Follow me on Twitter!</a>
		</section>
	</div>
</div>
<?php dpm($mytweettime); ?>