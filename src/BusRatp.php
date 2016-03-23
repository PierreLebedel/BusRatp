<?php

class BusRatp{

	public $type;
	public $type_display;
	public $line;
	public $line_display;
	public $direction;
	public $stop;
	public $stop_display;
	public $stops;

	static $base_url = 'http://wap.ratp.fr/siv/schedule?';

	public function __construct($default_line='39'){
		$this->type = 'bus';
		$this->line = $this->getLine($default_line);
		$this->stop = $this->getStop();

		$this->getStops();

		if( $this->stop && array_key_exists($this->stop, $this->stops) ){
			$this->getData();
		}else{
			reset($this->stops);
			$this->stop = key($this->stops);
			$this->getData();
		}
	}

	public function getData(){
		$params = http_build_query(array(
			'service'   => 'next',
			'reseau'    => $this->type,
			'linecode'  => $this->line,
			'stationid' => $this->stop
		));
		$html   = self::curlCall(self::$base_url.$params);
		
		if( $object = self::cleanRatpHtmlData($html) ){
			self::cookie('line', $this->line);
			self::cookie('stop', $this->stop);

			$this->type_display = $object->type;
			$this->line_display = $object->line;
			$this->stop_display = $object->stop;
			$this->directions   = $object->directions;
		}
	}

	public function getStops(){
		$params = http_build_query(array(
			'service'     => 'next',
			'reseau'      => $this->type,
			'linecode'    => $this->line,
			'stationname' => '*'
		));
		$html = self::curlCall(self::$base_url.$params);
		$this->stops = self::cleanRatpHtmlStops($html);
	}

	public static function cleanRatpHtmlStops($xmlstring){
		$dom = new DOMDocument();
		$dom->loadHTML($xmlstring);

		$stops = array();
		foreach($dom->getElementsByTagName('a') as $node){
			$infos = parse_url($node->getAttribute('href'));
			if( isset($infos['query']) ){
				$args = explode('&', $infos['query']);
				if( isset($args[3]) ){
					$k = str_replace('stationid=', '', $args[3]);
		    		$stops[$k] = strip_tags($dom->saveHTML($node));
				}
			}
		}
		return $stops;
	}

	public static function cookie($k, $v=false){
		if($v){
			setcookie($k, $v, time()+(3600*24*360), "/");
		}else{
			return $_COOKIE['stop'];;
		}
	}

	public static function curlCall($url){
		$options = array(
			CURLOPT_CUSTOMREQUEST  => "GET",
			CURLOPT_POST           => false,
			CURLOPT_USERAGENT      => $_SERVER['HTTP_USER_AGENT'],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER         => false,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_AUTOREFERER    => true,
			CURLOPT_CONNECTTIMEOUT => 120,
			CURLOPT_TIMEOUT        => 120,
			CURLOPT_MAXREDIRS      => 10,
		);
		$ch      = curl_init($url);
		curl_setopt_array($ch, $options);
		$content = curl_exec($ch);
		//$err     = curl_errno($ch);
		//$errmsg  = curl_error($ch);
		//$header  = curl_getinfo($ch);
		curl_close($ch);
		return $content;
	}

	public static function cleanRatpHtmlData($xmlstring){
		$dom = new DOMDocument();
		$dom->loadHTML($xmlstring);

		$divs = array();
		foreach($dom->getElementsByTagName('div') as $node){
    		$divs[] = $dom->saveHTML($node);
		}
		//self::debug($divs);

		if( self::cleanRatpHtmlTag($divs[1])=='Saisir le numéro ou le nom de la ligne de Bus' ){
			return false;
		}

		$imgsAlt = array();
		foreach($dom->getElementsByTagName('img') as $node){
    		$imgsAlt[] = $node->getAttribute('alt');
		}
		//self::debug($imgsAlt);
		
		$data = array(
			'type'      => self::cleanRatpHtmlTag($imgsAlt[0], ':'),
			'line'      => self::cleanRatpHtmlTag($imgsAlt[1], array('[', ']')),
			'stop'      => self::cleanRatpHtmlTag($divs[2], 'Arrêt'),

			'directions' => array(
				(object) array(
					'direction' => self::cleanRatpHtmlTag($divs[6], 'Direction'),
					'stops'     => array(
						(object) array(
							'terminus' => self::cleanRatpHtmlTag($divs[7], '&gt;'),
							'timeout'  => self::cleanRatpHtmlTag($divs[8], ''),
						),
						(object) array(
							'terminus' => self::cleanRatpHtmlTag($divs[9], '&gt;'),
							'timeout'  => self::cleanRatpHtmlTag($divs[10], ''),
						),
					),
				)
			),
		);

		if( count($divs)==35 ){
			// bus dans les deux directions
			$data['directions'][] = (object) array(
				'direction' => self::cleanRatpHtmlTag($divs[12], 'Direction'),
				'stops'     => array(
					(object) array(
						'terminus' => self::cleanRatpHtmlTag($divs[13], '&gt;'),
						'timeout'  => self::cleanRatpHtmlTag($divs[14], ''),
					),
					(object) array(
						'terminus' => self::cleanRatpHtmlTag($divs[15], '&gt;'),
						'timeout'  => self::cleanRatpHtmlTag($divs[16], ''),
					),
				),
			);
		}

		//self::debug($data);
		return (object) $data;
	}

	public static function cleanRatpHtmlTag($tag, $replace=''){
		$tag = strip_tags($tag);
		$tag = str_replace($replace, '', $tag);
		$tag = trim($tag);
		return $tag;
	}

	public static function debug($var, $info=false){
		echo '<div style="padding:5px 10px; margin-bottom:8px; font-size:13px; background:#FACFD3; color:#8E0E12; line-height:16px; border:1px solid #8E0E12; text-transform:none; overflow:auto;">';
			if($info) echo '<h3 style="color:#8E0E12; font-size:16px; padding:5px 0;">'.$info.'</h3>';
			echo '<pre style="white-space:pre-wrap;">'.print_r($var,true).'</pre>
		</div>';
	}

	public function getLine($default_line){
		if( isset($_GET['line']) ){
			return $_GET['line'];
		}else if( $cookie=self::cookie('line') ){
			return $cookie;
		}else{
			return $default_line;
		}
	}

	public function getStop(){
		if( isset($_GET['stop']) ){
			return $_GET['stop'];
		}else if( $cookie=self::cookie('stop') ){
			return $cookie;
		}else{
			return false;
		}
	}

}
