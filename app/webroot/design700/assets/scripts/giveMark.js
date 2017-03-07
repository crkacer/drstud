function getMark() {
					var m = document.getElementById("mark").value;
  					var q = document.getElementById("sid");
  					var qq = parseInt(q.textContent);
  					var i = String(qq);
  					// console.log(m);
  					// console.log(i);
    				$.ajax({
        				type: "POST",
        				url: "/../../design700/assets/scripts/mark.php",
        				data: { mark: m, id : i}
          			}).done(function(data) {
        			console.log(data);
      				});
				}