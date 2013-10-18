/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function($) {
    /**
     * Add form via ajax dependencie of what source type selected user.
     */
    $(document).on("change","#tracking_types_form_trackingTypes",function(){
       var optionSelected = $(this).find('option:selected');
       var sourceType = optionSelected.val();
       if(sourceType.length > 0){
          sourceType = sourceType.toLowerCase()
          var formActionUrl = $("#selectSourceType").attr("action");
            var ajaxRequest = $.ajax({
                url: formActionUrl + "/" + sourceType,
                type: "POST",
                data: {sourceType: sourceType},
                beforeSend: function(){
                    showLoader();
                }
            });
            
            ajaxRequest.done(function(response) {
                $("#formType").html(response);
            });

            ajaxRequest.fail(function(jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
       }else{
           $("#formType").empty();
       }
       
       /**
        * Show loader with dark display effect for ajax requests.
        * @returns {undefined}
        */
       function showLoader(){
           $("#freezeLoader").addClass("loader-dark-class");
       }
       
       /**
        * Hide loader with dark display effect for ajax requests.
        * @returns {undefined}
        */
       function hideLoader(){
           $("#freezeLoader").removeClass();
       }
       
       $(document).ajaxStop(function(){
            hideLoader(); 
       });
    });
})(jQuery);

