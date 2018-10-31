<?php
class Highlight {
	
	private function getColors() {
		$color['1'] = "<span style='color: rgb(0, 0, 192);'>";
		$color['2'] = "<span style='color: rgb(0, 191, 0);'>";
		$color['3'] = "<span style='color: rgb(0, 190, 190);'>";
		$color['4'] = "<span style='color: rgb(190, 0, 0);'>";
		$color['5'] = "<span style='color: rgb(190, 0, 190);'>";
		$color['6'] = "<span style='color: rgb(216, 163, 51);'>";
		$color['7'] = "<span style='color: rgb(190, 190, 190);'>";
		$color['8'] = "<span style='color: rgb(62, 62, 62);'>";
		$color['9'] = "<span style='color: rgb(63, 64, 252);'>";
		$color['0'] = "<span style='color: rgb(0, 0, 0);'>";
		$color['a'] = "<span style='color: rgb(63, 254, 63);'>";
		$color['b'] = "<span style='color: rgb(62, 255, 254);'>";
		$color['c'] = "<span style='color: rgb(253, 63, 63);'>";
		$color['d'] = "<span style='color: rgb(255, 63, 255);'>";
		$color['e'] = "<span style='color: rgb(254, 254, 62);'>";
		$color['f'] = "<span style='color: rgb(255, 255, 255);'>";
		$color['r'] = "<span style='color: rgb(255, 255, 255);'>";
		$color['n'] = "<span style='text-decoration: underline;'>";
		$color['m'] = "<em>";
		$color['l'] = "<b>";
		$color['o'] = "<s>";
		return $color;
	}
	
	private function getLatest($str) {
		if(stristr($str, "<span")) {
			return "</span>";
		}
		if(stristr($str, "<b>")) {
			return "</b>";
		}
		if(stristr($str, "<s>")) {
			return "</s>";
		}
		if(stristr($str, "<em>")) {
			return "</em>";
		}
	}
	
	public function textToColorCode($text) {
		$colorList = Array(
			'dark_blue' => '1',
			'dark_green' => '2',
			'dark_aqua' => '3',
			'dark_red' => '4',
			'dark_purple' => '5',
			'gold' => '6',
			'gray' => '7',
			'dark_gray' => '8',
			'blue' => '9',
			'black' => '0',
			'green' => 'a',
			'aqua' => 'b',
			'red' => 'c',
			'light_purple' => 'd',
			'yellow' => 'e',
			'white' => 'f',
			'reset' => 'gr',
			'bold' => 'l',
			'italic' => 'o',
			'underline' => 'n',
			'strike' => 'm',
		);
		$text = strtolower($text);
		if(isset($colorList[$text])) {
			$color = "§{$colorList[$text]}";
		} else {
			$color = "§r";
		}
		return $color;
	}
	
	public function convert($str) {
		$tagStart = false;
		$tagOpen = false;
		$color = $this->getColors();
		$tmpColor = $color['f'];
		$long = mb_strlen($str, "UTF-8");
		$result = "";
		for($s = 0; $s < $long; $s++) {
			$cutStr = mb_substr($str, $s, 1);
			if($cutStr == "§") {
				$tagStart = true;
			} else {
				if($tagStart) {
					if(preg_match("/^[A-Za-z0-9]$/", $cutStr)) {
						if($tagOpen) {
							$result .= $this->getLatest($tmpColor);
							$tagOpen = false;
						}
						$tmpColor = $color[$cutStr];
						$tagStart = false;
						$result .= $tmpColor;
						$tagOpen = true;
					} elseif($curstr == "r" && $tagStart) {
						$tagStart = false;
						$result .= $this->getLatest($tmpColor);
						$tagOpen = false;
						$tmpColor = $color['f'];
					} else {
						$tagStart = false;
						$tmpColor = $color['f'];
					}
				} else {
					if(ord($cutStr) !== 0) {
						$result .= $cutStr;
					}
				}
			}
		}
		if($tagOpen) {
			$result .= $this->getLatest($tmpColor);
			$tagOpen = false;
		}
		return $result;
	}
}