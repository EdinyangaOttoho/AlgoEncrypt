<?php
	class Algo {
		public $ref_num;
		public $ref_let;
		public $ref_caps_let;

		public $let_key_value_pair;
		public $num_key_value_pair;

		function __construct () {
			$this->ref_num = ["0","1","2","3","4","5","6","7","8","9"];
			$this->ref_let = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
			$this->ref_caps_let = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

			$this->let_key_value_pair = ["A"=>"26","B"=>"25","C"=>"24","D"=>"23","E"=>"22","F"=>"21","G"=>"20","H"=>"19","I"=>"18","J"=>"17","K"=>"16","L"=>"15","M"=>"14","N"=>"13","O"=>"12","P"=>"11","Q"=>"10","R"=>"9","S"=>"8","T"=>"7","U"=>"6","V"=>"5","W"=>"4","X"=>"3","Y"=>"2","Z"=>"1"];
			$this->num_key_value_pair = ["0"=>"C","1"=>"D","2"=>"E","3"=>"F","4"=>"G","5"=>"H","6"=>"I","7"=>"J","8"=>"K","9"=>"L"];
		}

		function encrypt($string) {
			$step1 = array();
			for ($i = 0; $i < strlen($string); $i++) {
				if (in_array($string[$i], $this->ref_num)) {
					array_push($step1, base64_encode("*".$this->num_key_value_pair[$string[$i]]."*"));
				}
				else if (in_array($string[$i], $this->ref_let)) {
					array_push($step1, base64_encode("[".$this->let_key_value_pair[strtoupper($string[$i])]."]"));
				}
				else if (in_array($string[$i], $this->ref_caps_let)) {
					array_push($step1, base64_encode("[^".$this->let_key_value_pair[strtoupper($string[$i])]."]"));
				}
				else if ($string[$i] == " ") {
					array_push($step1, base64_encode("<".mt_rand(0, 9999).">"));
				}
				else {
					array_push($step1, base64_encode("u".$string[$i]."u"));
				}
			}
			$string = "MC0w";
			$delimiter = mt_rand(0,9999).$string.mt_rand(0,9999);
			$hash = implode($delimiter, $step1);
			return urlencode(urlencode($hash));

		}
		function decrypt($hash) {
			$step1 = preg_replace("/[0-9]+MC0w[0-9]+/", ",", urldecode(urldecode($hash)));
			$arr = array();
			if (strpos($step1, ",") !== false) {
				$arr = explode(",", $step1);
			}
			else {
				$arr[0] = $step1;
			}

			$glob = "";

			foreach ($arr as $i) {
				if (strpos(base64_decode($i), "[") !== false) {
					$string = str_replace("[", "", str_replace("]", "", base64_decode($i)));
					if ($string[0] == "^") {
						$string = str_replace("^", "", $string);
						foreach ($this->let_key_value_pair as $k=>$v) {
							if ($v == $string) {
								$glob.=$k;
							}
						}
					}
					else {
						foreach ($this->let_key_value_pair as $k=>$v) {
							if ($v == $string) {
								$glob.=strtolower($k);
							}
						}	
					}
				}
				else if (strpos(base64_decode($i), "*") !== false) {
					$string = str_replace("*", "", base64_decode($i));
					foreach ($this->num_key_value_pair as $k=>$v) {
						if ($v == $string) {
							$glob.=$k;
						}
					}
				}
				else if (strpos(base64_decode($i), "<") !== false) {
					$string = str_replace("<", "", str_replace(">", "", base64_decode($i)));
					$glob.=preg_replace("/[0-9]+/", " ", $string);
				}
				else {
					$string = str_replace("u", "", base64_decode($i));
					$glob .= $string;
				}
			}
			return $glob;
		}
		function verify($hash, $password) {
		    $algo = new Algo();
    		$decrypted = $algo->decrypt($hash);
    		if ($decrypted === $password) {
    			return true;
    		}
    		else {
    			return false;
    		}
		}
	}
	function algo_hash($hash) {
		$algo = new Algo();
		$encrypted = $algo->encrypt($hash);
		return $encrypted;
	}
	function algo_verify($hash, $password) {
		$algo = new Algo();
		$decrypted = $algo->decrypt($hash);
		if ($decrypted === $password) {
			return true;
		}
		else {
			return false;
		}
	}
?>