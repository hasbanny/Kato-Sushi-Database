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
            $('#sign').attr("hidden", true)//hiding login form
            //$('#login').attr("hidden", false)//showing alternative page
            $('#greet').attr("hidden", false)//showing alternative page
            //$("#user").text(data["name"]+'!')//displaying username
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
            $('#userx').attr("hidden", true)//hide error msg
            $('#wrong').attr("hidden", true)//hide error msg
            $('#form').attr("hidden", false)//show login form
            $('#login').attr("hidden", true)//hide login page
            $('#greet').attr("hidden", true)//hide login page
            $("#exampleInputEmail1").val('')//clear txtbox
            $("#exampleInputPassword1").val('')//cleartxtbox
        }
     })
})