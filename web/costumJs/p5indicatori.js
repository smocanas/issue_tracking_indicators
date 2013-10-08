/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function($) {
    $(document).ready(function() {
        $("#add_source_form").on("click",function(){
            var button = $(this);
            button.hide();
            $("#source_form").effect( "bounce", "slow");
        });
    });
})(jQuery);
