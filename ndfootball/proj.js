

function init(){
	console.log('javascript successfully connected');
	document.getElementById("query_button").onclick = function() {
		console.log('query button clicked');
		$.ajax({
			type: 'POST',
			url: "/cse30246/ndfootball/python_stuff.py",
			success: function(response){
				console.log('worked');
				console.log(response);
			}
		});
	}
}
