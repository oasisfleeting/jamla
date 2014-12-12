/**
 * Created by desktop on 12/3/2014.
 */

jQuery(document).ready(function(){
   jQuery('.request-btn').click(function(){
       var reqid = jQuery(this).attr('id');
       var url = 'index.php?option=com_jamla&task=artist.request&songid=' + reqid;
       jQuery.get(url,function(response){
           console.log(response);
       });
   });
});
