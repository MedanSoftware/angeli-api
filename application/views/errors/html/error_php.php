<?php defined('BASEPATH') OR exit('No direct script access allowed');
header('content-type:application/json');

$debug_backtrace = array();

foreach (debug_backtrace() as $error) {
	if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0) {
		array_push($debug_backtrace, array(
			'file' => $error['file'],
			'line' => $error['line'],
			'function' => $error['function']
		));
	}
}

exit(json_encode(array(
	'status' => 'error',
	'message' => 'A PHP Error was encountered'.' | '.$message,
	'data' => array(
		'severity' => isset($this->levels[$severity]) ? $this->levels[$severity] : $severity,
		'filepath' => $filepath,
		'line' => $line,
		'debug_backtrace' => $debug_backtrace
	)
)));