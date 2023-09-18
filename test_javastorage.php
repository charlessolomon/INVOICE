
<script>
$(window).on("load", onPageLoad);
 
function onPageLoad() {
	initListeners();
	restoreSavedValues();
}
 
// Add all listeners in this method
function initListeners() {
 
	$("#payoption").on("change", function() {
		var value = $(this).val();
		localStorage.setItem("payoption", value);
	});
 
	// Add other dropdowns and other inputs that you want to listen ...
 
}
 
// Restore all saved values in this method
function restoreSavedValues() {
 
	$("#payoption").on("change", function() {
		var value = $(this).val();
		localStorage.setItem("payoption", value);
	});
 
	// Restore other values that were previously stored here ...
 
}
</script>
<script>
window.onload = function custsave() {
    var selItem = sessionStorage.getItem("selItem");  
    $('#payoption').val(selItem);
    }
    $('#payoption').change(function() { 
        var selVal = $(this).val();
        sessionStorage.setItem("selItem", selVal);
    });
</script>
<html>
<table>
<tr>
<td width="250" align="center">Pay Type <select name="payoption" id="payoption" onblur="custsave()"">
  		<option>CASH</option>
  		<option>POS/CARD</option>
  		<option>E-TRANSFER</option>
  		<option>CREDIT</option>
		</select></td>
</tr>
</table>
</html>

<?php



?>