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
    /**
     * Show loader with dark display effect for ajax requests.
     * @returns {undefined}
     */
    function showLoader() {
        $("#freezeLoader").addClass("loader-dark-class");
    }

    /**
     * Hide loader with dark display effect for ajax requests.
     * @returns {undefined}
     */
    function hideLoader() {
        $("#freezeLoader").removeClass();
    }

    $(document).ajaxStop(function() {
        hideLoader();
    });

    /**
     * Add source via ajax
     */
    $(document).unbind("submit").on("submit", "#addSourceForm", function(e) {
        var formActionUrl = $(this).attr('action');
        var ajaxRequest = $.ajax({
            url: formActionUrl,
            type: "POST",
            data: $(this).serialize(),
            context: $(this),
            beforeSend: function() {
                showLoader();
            }
        });

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

    function setSuccMessage(succMsg) {
        $("#messageAlert")
                .html('<div id="hide"  class="alert alert-success">' + succMsg + '</div>')
                .show();
        $("#hide").delay(5000).fadeOut(300);
    }

    function setErrMessage(errMsg) {
        $("#messageAlert")
                .html('<div class="alert alert-error">' + errMsg + '</div>').show();
    }
    
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
                $(".dp3").datepicker();
            });

            ajaxRequest.fail(function(jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        } else {
            $("#restOfTheForm").empty();
        }

    });
})(jQuery);

