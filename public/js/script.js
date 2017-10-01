$(".cohort-select#to-cohort").change(function(){
	window.location = "/cohorts/" + this.value;
})

$(".cohort-select#to-term").change(function(){
	window.location = "/terms/find/" + this.value;
})