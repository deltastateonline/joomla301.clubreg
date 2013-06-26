<?php
function write_debug($d_data){
	echo "<pre>";
	var_dump($d_data);
	echo "</pre>";
}
function write_trace(){
	echo "<pre>";
	echo debug_print_backtrace();
	echo "</pre>";
}