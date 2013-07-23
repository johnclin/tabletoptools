<html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	function rolldice(){
		try{
			var dieCount = document.getElementById('dieCount').value;
			var dietype = document.getElementById('dieType').value;
			var times = document.getElementById('times').value;
			var keep = document.getElementById('dieCount').value;
			var open = false;
			
			if (false == document.getElementById('keep').hidden){
				keep = document.getElementById('keep').value;
			}
			
			if (false == document.getElementById('open').hidden){
				open = document.getElementById('open').value;
			}
			
			$.ajax({
				type: "POST",
				url: "../controller/DiceRoller.php?method=rollDice&count="+dieCount+"&type="+dietype+"&keep="+keep+"&open="+open+"&times="+times,
				success: function(data){
					var result = jQuery.parseJSON(data);
					result.forEach(displayResults)
				}
			})
		}catch(error){
		}
	}
	
	function displayResults(element, index, array){
		var table = document.getElementById("results");
		var row=table.insertRow(1);
		var result=row.insertCell(0);
		
		result.innerHTML="Rolled: "+element.rolled+" Kept: "+element.kept+" Total: "+element.sum;
	}
	
	function keepToggle(){
		var isHidden = document.getElementById('keep').hidden;
		if(true == isHidden){
			document.getElementById('keep').hidden=false;
			document.getElementById('keepText').innerHTML = "Keeping Some...(click to change)";
		}else{
			document.getElementById('keep').hidden=true;
			document.getElementById('keepText').innerHTML = "Keeping All...(click to change)";
		}
	}
	
	function openToggle(){
		var isHidden = document.getElementById('open').hidden;
		if(true == isHidden){
			document.getElementById('open').hidden=false;
			document.getElementById('openText').innerHTML = "Explodes On...(click to change)";
		}else{
			document.getElementById('open').hidden=true;
			document.getElementById('openText').innerHTML = "Does Not Explode...(click to change)";
		}
	}
</script>
    <h1>Free Rolling</h1>
    <h3>Simple dice rolling.  No tracking.</h3>
    
    <table>
		<tr>
            <td>Number of Dice</td>
            <td><input type="text" id="dieCount" value="1" size=1></td>
        </tr>
        <tr>
            <td>dieType</td>
            <td><input type="text" id="dieType" size=1></td>
        </tr>
		<tr>
            <td>Dice Kept</td>
            <td><div id=keepText onclick="keepToggle()">Keeping All (click to change)</div><input type="text" id="keep" size=1 value="1" hidden=true></td>
        </tr>
		<tr>
            <td>Open Ended Dice</td>
            <td><div id=openText onclick="openToggle()">Does not Explode (click to change)</div><input type="text" id="open" size=1 value="false" hidden=true></td>
        </tr>
        <tr>
            <td>Times to Roll</td>
            <td><input type="text" id="times" value="1" size=1></td>
        </tr>
        <tr>
			<td><button onclick="rolldice()">Roll</button></td>
		</tr>
    </table>
    
	<table id='results'>
		<tr>
			<td>Results</td>
		</tr>
	</table>
    
</html>