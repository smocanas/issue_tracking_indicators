/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function($) {
    /**
     * Add form via ajax dependencie of what source type selected user.
     */
    $(document).on("change", "#tracking_types_form_trackingTypes", function() {
        var optionSelected = $(this).find('option:selected');
        var trackingTypes = optionSelected.val();
        if (trackingTypes.length > 0) {
            trackingTypes = trackingTypes.toLowerCase()
            var formActionUrl = $("#selectSourceType").attr("action");
            var ajaxRequest = $.ajax({
                url: formActionUrl + "/" + trackingTypes,
                type: "POST",
                data: {trackingTypes: trackingTypes},
                beforeSend: function() {
                    showLoader();
                }
            });

            ajaxRequest.done(function(response) {
                $("#formType").html(response);
            });

            ajaxRequest.fail(function(jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        } else {
            $("#formType").empty();
        }

    });

    $(document).ajaxStop(function() {
        hideLoader();
    });

    /**
     * Add source via ajax
     */
    $(document).on("submit", "#addSourceForm", function(e) {
        var ajaxRequest = sendFormDataWithAjax($(this));
        
        ajaxRequest.done(function(response) {
            if (response.success) {
                setSuccMessage("Source added succesfully.")
                $("#mainFormDiv").html(response.formHtml);
            } else {
                if (response.exception != null) {
                    setErrMessage(response.exception);
                } else {
                    $("#messageAlert").empty();
                }
                $("#mainFormDiv").html(response.formHtml);
            }
        });

        ajaxRequest.fail(function(jqXHR, textStatus) {
            setErrMessage("Request failed: " + textStatus);
        });

        return false;
    });
    
    $(document).on("change", "#project_filter_form_projectName", function() {
        var optionSelected = $(this).find('option:selected');
        var projectKey = optionSelected.val();
        if (projectKey.length > 0) {
            var formActionUrl = $("#projectNamesForm").attr("action");
            var sourceId = $("#project_filter_form_sourceId").val();
            var ajaxRequest = $.ajax({
                url: formActionUrl,
                type: "POST",
                data: {projectKey: projectKey, sourceId: sourceId},
                beforeSend: function() {
                    showLoader();
                }
            });

            ajaxRequest.done(function(response) {
                $("#restOfTheForm").html(response);
                $(".dp3").datepicker({
                    orientation: "auto"
                });
            });

            ajaxRequest.fail(function(jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        } else {
            $("#restOfTheForm").empty();
        }

    });
    
    
    $(document).on("submit", "#baseFilterForm", function(e) {
        var ajaxRequest = sendFormDataWithAjax($(this));

        ajaxRequest.done(function(response) {
           
        });

        ajaxRequest.fail(function(jqXHR, textStatus) {
            setErrMessage("Request failed: " + textStatus);
        });

        return false;
    });
})(jQuery);

