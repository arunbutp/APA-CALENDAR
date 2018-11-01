function post_value(mm,dt,yy){
	opener.document.f1.p_name.value = mm + "/" + dt + "/" + yy;
	/// cheange the above line for different date format
	self.close();
}

function reload(form){
	var month_val=document.getElementById('month').value; // collect month value
	var year_val=document.getElementById('year').value;      // collect year value
	self.location='index.php?month=' + month_val + '&year=' + year_val ; // reload the page
}