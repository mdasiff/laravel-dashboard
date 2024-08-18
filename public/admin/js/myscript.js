$(function () {
    $(document.body).on("click",".my_button",function(){
        //Your Code Here
    });

    // $(document.body).on("change","#level_main",function(){
    //     var val = $(this).val();
    //     $.ajax({
    //         type: "POST",
    //         url: "/admin/navigation/get-level-1-list",
    //         data: {"val": val, "_token": "{{ csrf_token() }}"},
    //         dataType: "html",
    //         success: function(resultData){
    //             $('#level_1').html(resultData);
    //         }
    //     });
    //     return false;
    // });
});