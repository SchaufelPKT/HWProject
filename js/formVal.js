$(document).ready(function(){
    
    $("#register").validate({
        rules:{
            fname:{
                required: true,
				rangelength:[1,50]
            },
            lname:{
				required: true,
				rangelength:[1,50]
			},
			add1:{
				required: true,
				rangelength:[1,50]
			},
			add2:{
				rangelength:[1, 50]
			},
			city:{
				required: true,
				rangelength:[1,20]
			},
			zip:{
				required: true,
				rangelength:[5,10]
			}

        }
    },{
        messages:{
            fname:{
                required: "This is a required field",
                rangelength: "Must be shorter than 50 characters"
            },
            lname:{
                required: "This is a required field",
                rangelength: "Must be shorter than 50 characters"
            },
			add1:{
                required: "This is a required field",
                rangelength: "Must be shorter than 50 characters"
            },
			add2:{
				rangelength: "Must be shorter than 50 characters"
			},
			city:{
                required: "This is a required field",
                rangelength: "Must be shorter than 20 characters"
            },
			zip:{
				required: "This is a required field",
				rangelength: "Must enter a 5 or 9 character zipcode"
			}
        }
    });
});