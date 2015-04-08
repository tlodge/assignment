function ViewModel(){
	
	this.firstname = ko.observable("tommmy");
	
	this.lastname  = ko.observable("lodge");
	
	this.submit = function(){
		console.log("submitting!!");
		 $.ajax({
                url: "/feedback",
                type: "POST",
                data: {message:"this is some feedback", somethingelse:"and so is this"},
                dataType: 'json',
            	success: function(result){
                    console.log(result);    
                },
              	error: function(XMLHttpRequest, textStatus, errorThrown){
                	console.log(errorThrown);
                }       
        });
	}
}

ko.applyBindings(new ViewModel(), $("#maincontent")[0]);
