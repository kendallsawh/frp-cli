<?php

function sanitize($input) { 
	if(is_string($input)){
		$bad = array("'", '"', '`', '/');
		$safe = array('&#039;', '&quot;', '&#96;', '&#47;');
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		$input = str_replace($bad,$safe,$input);
		return $input;
	}else{
		return $input; 
	}
}

function proofMandatory()
{
	$proofs = \App\TenureProofRelation::all();
	$proof_mandatory = [];
	foreach ($proofs as $proof) {
            // app type -> land type -> tenure -> document
		$proof_mandatory[$proof->app_id][$proof->land_id][$proof->tenure_id][] = $proof->proof_id;
	}
	return $proof_mandatory;
}

function proofOptional()
{
	$proofs = \App\TenureProofRelOpt::all();
	$proof_optional = [];
	foreach ($proofs as $proof) {
            // app type -> land type -> tenure -> document
		$proof_optional[$proof->app_id][$proof->land_id][$proof->tenure_id][] = $proof->proof_id;
	}
	return $proof_optional;
}

function proofOptionalCondition()
{
	$proofs = \App\TenureProofRelOpt::all();
	$proof_optional = [];
	foreach ($proofs as $proof) {
            // app type -> land type -> tenure -> document
		$proof_optional[$proof->app_id][$proof->land_id][$proof->tenure_id][$proof->proof_id][] = $proof->conditional;
	}
	return $proof_optional;
}

function shortlistCombos()
{
	$combos = \App\AppLandTenure::all();
	$list = [];
	foreach ($combos as $opt) {
            // app type -> land type -> tenure
		$list[$opt->app_id][$opt->land_id][] = $opt->tenure_id;
	}
	return $list;
}