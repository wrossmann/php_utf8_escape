<?php
require(__DIR__ . '/../vendor/autoload.php');

$input = "आए थे पर्यटक, खुद ही बह गए";
var_dump(
	utf8_escape($input),
	utf8_escape($input, false)
);
