/********
 * This file contains JS code required for AJAX pagination with a list that uses Alaxos filter fields
 * 
 * The method start_alaxos_list() must be called by the 'complete' callback of the PaginatorHelper options.
 ********/

function search()
{
	/*
	* find all filters fields/values
	*/
	var data = "";
	$j("tr.searchHeader input").each(function(){
		data += $j(this).attr("name") + "=" + encodeURI($j(this).val()) + "&";
	});
	
	$j("tr.searchHeader select").each(function(){
		/*
		 * Note:	with IE, .val() on a 'select' list seems to fail,
		 * 		 	while 'option:selected' seems to work fine...
		 */
		data += $j(this).attr("name") + "=" + encodeURI($j(this).find("option:selected").attr("value")) + "&";
	});
	
	/*
	 * Remove any filter from the URL as it would prevent to modify the filters 
	 */
	var url = String(document.location);
	if(url.indexOf("filter:") != -1)
	{
		url = url.substring(0, url.indexOf("filter:"));
	}
	
    $j.ajax({
    	type: "post",
    	url: url,
    	data: data,
    	beforeSend: function(request){
    		
    		$(".spinner").css("display", "block");
    		
        },
    	success: function(data) {
    			
			$('#content').html(data);
			
			start_alaxos_list();
	    	
	    	$(".spinner").css("display", "none");
    	}
    });
}

function start_alaxos_list()
{
	/*
	 * restart alaxos plugin JS to be effective in the updated zone
	 */ 
	start_alaxos();
	
	/*
	 * restart datepicker JS to be effective in the updated zone
	 */
	datePickerController.destroy();
	datePickerController.create();
}