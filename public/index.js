var owner_name='no';
$('#log').on("click", function (t) {
    t.preventDefault()
    user = $("#exampleInputEmail1").val()
    pass = $("#exampleInputPassword1").val()
    $.ajax({
        url: baseurl + "/login",
        type: 'POST',
        data: {owner_id : user, password : pass},
        dataType: "json"
    })
    .done(function(data){
        // deal with error code in response
        if(data["status"]==0){
            $('#wrong').attr("hidden", false)//showing error msg for wrong pass
        }
        else if(data["status"]=='1'){ 
            window.location = baseurl + "/log/owner_view"
        }
        else if(data["status"]=='2'){
            $('#userx').attr("hidden", false)//checking if the user exists in db
        }
     })
})

//LOGOUT AJAX
$('#logout').on("click", function (t) {
    t.preventDefault()
    $.ajax({
        url: baseurl + "/logout",
        type: 'POST',
        dataType: "json"
    })
    .done(function(data) {
        // deal with error code in response
        if(data["success"]=="true"){
            window.location = baseurl + "/log"
        }
     })
})