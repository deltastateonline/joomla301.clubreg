function reloadSubgroup(){	
	var group_id = $("jform_group_id").value;

	$("subDivisionDiv").set("html","Loading ..");	
	var url = "index.php?option=com_clubreg&view=clubgroups&layout=subgroups&group_id="+group_id+"&tmpl=component";	
	$("subDivisionDiv").load(url);
	//$("sbox-content").set("html"," ");
}


window.addEvent('domready', function() {	
	reloadSubgroup();
});