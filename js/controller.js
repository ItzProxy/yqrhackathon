app.controller("LoginController",function($scope,$location){
   $scope.loginError = (new URL(location)).searchParams.get("error");
});

app.controller("MainController",function($scope){
    
});

app.controller("DogController",function($scope){
    $(document).ready(function(){
        $('.modal').modal();
    });
    //remove later
    initEventModal("#add-event");
    initEventModal("#notify-urgent"); 
});

app.controller("UpdateController",function($scope){
    $(document).ready(function(){
        $('.modal').modal();
    });    
});

app.controller("PeopleController",function($scope){
    $(document).ready(function(){
        $('.modal').modal();
    });    
    $(".user-card .media").click(function(){
        $("#notify-modal").modal('open');
        $("#notify-modal input[name=to]").val($(this).attr('data-email'));
        Materialize.updateTextFields();
    });
});

function initEventModal(modal_id){
    $(modal_id+" .media").click(function(){
       $(modal_id+" input[name=media-file]").click();
    });
    $(modal_id+" input[name=media-file]").change(function(){
       $(modal_id+" .media .help-txt").hide(); 
       $(modal_id+" .loading").show();
       var input = document.querySelector(modal_id+" input[name=media-file]");
       if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(modal_id+" .img-preview").show();
            var img = $(modal_id+" .img-preview");
            img.attr('src', e.target.result);
            img.ready(function(){
                $(modal_id+" .loading").hide();
            });                        
        };
        reader.readAsDataURL(input.files[0]);
    }
    });
    $(modal_id+" .loading,"+modal_id+" .img-preview,"+modal_id+" .video-preview ").hide();
    $(modal_id+" button[type=reset]").click(function(){
        $(modal_id+" .loading,"+modal_id+" .img-preview,"+modal_id+" .video-preview ").hide();
        $(modal_id+" .media .help-txt").show();
    });
}