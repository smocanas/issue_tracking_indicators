/* 
 * Costum functions to acces in all js files.
 */


/**
 * Show loader with dark display effect for ajax requests.
 * @returns {undefined}
 */
function showLoader() {
    jQuery("#freezeLoader").addClass("loader-dark-class");
}

/**
 * Hide loader with dark display effect for ajax requests.
 * @returns {undefined}
 */
function hideLoader() {
    jQuery("#freezeLoader").removeClass();
}
/**
 * Set succes message with a given string, after 5 seconds the message
 * is hidden.
 * @param {string} succMsg
 * @returns {undefined}
 */
function setSuccMessage(succMsg) {
    jQuery("#messageAlert")
            .html('<div id="hide"  class="alert alert-success">' + succMsg + '</div>')
            .show();
    jQuery("#hide").delay(5000).fadeOut(300);
}

/**
 * Set error message.
 * @param {string} errMsg
 * @returns {undefined}
 */
function setErrMessage(errMsg) {
    jQuery("#messageAlert")
            .html('<div class="alert alert-error">' + errMsg + '</div>').show();
}

/**
 * Sending data from submited form.
 * @param {object} $this
 * @returns {jqXHR}
 */
function sendFormDataWithAjax($this) {
    var formActionUrl = $this.attr('action');
    var ajaxRequest = jQuery.ajax({
        url: formActionUrl,
        type: "POST",
        data: $this.serialize(),
        context: $this,
        beforeSend: function() {
            showLoader();
        }
    });

    return ajaxRequest;
}