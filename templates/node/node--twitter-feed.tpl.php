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

function returnTweet($token, $token_secret, $key, $key_secret, $handle){

  $oauth_access_token = $token;
  $oauth_access_token_secret = $token_secret;
  $consumer_key = $key;
  $consumer_secret = $key_secret;

  $twitter_timeline = "user_timeline";  //  mentions_timeline / user_timeline / home_timeline / retweets_of_me

  // Create request.
  $request = array(
  'screen_name' => $handle,
  'count' => '1'
  );

  $oauth = array(
	  'oauth_consumer_key' => $consumer_key,
	  'oauth_nonce' => time(),
	  'oauth_signature_method' => 'HMAC-SHA1',
	  'oauth_token' => $oauth_access_token,
	  'oauth_timestamp' => time(),
	  'oauth_version'  => '1.0'
  );

  //merge request and oauth to one array
  $oauth = array_merge($oauth, $request);

  //do some magic
  $base_info = buildBaseString("https://api.twitter.com/1.1/statuses/$twitter_timeline.json", 'GET', $oauth);
  $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
  $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
  $oauth['oauth_signature'] = $oauth_signature;

  //make request
  $header = array(buildAuthorizationHeader($oauth), 'Expect:');
  $options = array( 
  	CURLOPT_HTTPHEADER => $header,
    CURLOPT_HEADER => false,
    CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false
  );

  $feed = curl_init();
  curl_setopt_array($feed, $options);
  $json = curl_exec($feed);
  curl_close($feed);

  return json_decode($json, true);
       
}
// Store all the node field data needed to authorize feed.
$token = strip_tags(render($content['field_twitter_user_token']));
$token_secret = strip_tags(render($content['field_twitter_user_secret']));
$key = strip_tags(render($content['field_twitter_consumer_key']));
$key_secret = strip_tags(render($content['field_twitter_consumer_secret']));
$handle = strip_tags(render($content['field_twitter_handle']));

// Call the returnTweet() function passing field data variables as arguments.
$tweet_data = returnTweet($token, $token_secret, $key, $key_secret, $handle);

// Grab the raw text from the Tweet.
$tweet_text = $tweet_data[0]["text"];

// Grab the Tweet date/time and trim to just the date.
$tweet_created = explode(" ", $tweet_data[0]['created_at']);
$tweet_created_trimmed = implode(" ",array_splice($tweet_created,0,3));

// Get the links and add the markup.
$links = preg_match_all('/https?\:\/\/[^\" ]+/i',$tweet_text,$link);
if($link[0]) {
  foreach($link[0] as $url) {
    $tweet_text = str_replace($url, "<a href='$url'>$url</a>", $tweet_text);
  }
}

// Get the hashtags and add the markup.
$hashtags = preg_match_all('/#\w+/',$tweet_text,$hashtag);
if($hashtag[0]) {
  foreach($hashtag[0] as $tag) {
    $tweet_text = str_replace($tag, "<a href='http://twitter.com/$tag'>$tag</a>", $tweet_text);
  }
}

// Get the hashtags and add the markup.
$usernames = preg_match_all('/@\w+/',$tweet_text,$username);
if($username[0]) {
  foreach($username[0] as $name) {
    $tweet_text = str_replace($name, "<a href='http://twitter.com/$name'>$name</a>", $tweet_text);
  }
}

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
			<div class="tweet_time">
			  <a href="http://twitter.com/<?php print strip_tags(render($content['field_twitter_handle'])); ?>/status/<?php print $tweet_data[0]["id"]; ?>"><?php print $tweet_created_trimmed; ?></a>
			</div>
			<span class="tweet_text">
			  <?php print $tweet_text; ?>
			</span>
		</div>
		<!-- link to your twitter profile -->
		<a href="http://twitter.com/<?php print strip_tags(render($content['field_twitter_handle'])); ?>" class="rise-btn light small">Follow me on Twitter!</a>
		</section>
	</div>
</div>