<?php

class Json {

	public static function stringify($json, $options = 0) {
		if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
			return json_encode($json, $options);
		} elseif (version_compare(PHP_VERSION, '5.3.0', '>=')) {
			$json = json_encode($json, $options);
		} else {
			$json = json_encode($json);
		}
		$json = str_replace(array('\/', ':{', ':"', ':['), array('/', ': {', ': "', ': ['), $json);
		$found = preg_match_all('/:([0-9]+)/', $json, $matches);
		if ($found) {
			foreach ($matches[0] as $i => $search) {
				$json = preg_replace('/' . $search . '/', ': ' . $matches[1][$i], $json);
			}
		}
		$result			= '';
		$pos			= 0;
		$strLen			= strlen($json);
		$indentStr		= "\t";
		$newLine		= "\n";
		$prevChar		= '';
		$outOfQuotes	= true;
		for ($i = 0; $i <= $strLen; $i++) {
			$char = substr($json, $i, 1);
			if ($char == '"' && $prevChar != '\\') {
				$outOfQuotes = !$outOfQuotes;
			} elseif (($char == '}' || $char == ']') && $outOfQuotes) {
				$result .= $newLine;
				$pos --;
				for ($j = 0; $j < $pos; $j++) {
					$result .= $indentStr;
				}
			}
			$result .= $char;
			if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
				$result .= $newLine;
				if ($char == '{' || $char == '[') {
					$pos ++;
				}
				for ($j = 0; $j < $pos; $j++) {
					$result .= $indentStr;
				}
			}
			$prevChar = $char;
		}
		return $result;
	}
}
