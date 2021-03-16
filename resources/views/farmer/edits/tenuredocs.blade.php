/* 
* arrays with mandatory and optional relationships
*
* doc_mandatory 
* doc_optional
*
* app type -> land type -> tenure -> document
*/
var app = $('#app_type').val();
if (app) {
	var codes = true;
	doc_mandatory[app][land_type][tenure].forEach(function(item, index, arr) {
		if (!$('#proof_codes_'+n+'_'+item).is(':checked')) {
			codes=false;
		}
	});

	/*doc_optional[app][land_type][tenure].forEach(function(item, index, arr) {
		if (!$('#proof_codes_'+n+'_'+item).is(':checked')) {
			codes=false;
		}
	});*/

	if (!codes) {
		chk = btn = false;
		$('#err-proof_codes_'+n).html('The marked documents are required.');
	}
}