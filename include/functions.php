<?php
        
    function cpt_info_box()
        {
            ?>
                <div id="cpt_info_box">
                    <div id="donate_form">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="CU22TFDKJMLAE">
                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    </div>
                    
                    <p>Did you found useful this plug-in? Please support our work with a donation or write an article about this plugin in your blog with a link to our site <strong>http://www.nsp-code.com/</strong>.</p>
                    
                    <div class="clear"></div>
                </div>
            
            <?php   
        }

?>