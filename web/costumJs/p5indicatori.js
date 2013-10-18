/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function($) {
    $(document).on("click","#add_source_form", function() {
        var button = $(this);
        button.hide();
        $("#source_form").effect("bounce", "slow");
    });
})(jQuery);
