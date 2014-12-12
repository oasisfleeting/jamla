/**
 * Created by desktop on 12/3/2014.
 */

jQuery(document).ready(function(){
   jQuery('.request-btn').click(function(){
       var butClicked = jQuery(this);
       var reqid = butClicked.attr('id');
       var url = 'index.php?option=com_jamla&task=artist.request&songid=' + reqid;
       /*jQuery.get(url,function(response){
           butClicked.parent().parent().append('<div>testing</div>');
       });*/
   });
});
