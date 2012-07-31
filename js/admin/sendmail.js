$(function(){
$('#sendmail-form').submit(function(){
    $('#sendmail-form .failure').hide();
    // TODO validation
    // TODO lock screen
    $.ajax({
      type: 'POST',
      url: window.siteBase + '/manage/getmail',
      data: $('#sendmail-form').serialize(),
      dataType: 'json',
      success: function(data, textStatus, jqXHR){
        if (data.result === 'success') {
		$(function(){
		    $('#sendmail-form .progress .bar').width('0%');
		    $('#sendmail-form .progress').show();
		    var i=0;
		    var emails=json_decode(data.emails);
		    var l=emails.length;
		    var cnt=0;
		    for(i=0;i<l;i+=5){
			    var curmail=new Array();
			    for(j=0;j+i<l&&j<5;j++){
				    curmail.push(emails[i+j]);
			    }
			    var content=$('#mail-content').val();
			    var title =$('#mail-title').val();
			    $.ajax({
			      type: 'POST',
			      url: window.siteBase + '/manage/sendmail1',
			      data: { emails: json_encode(curmail),content: content , title: title },
			      dataType: 'json',
			      success: function(data, textStatus, jqXHR){
			        if (data.result === 'success') {
				    //$('#sendmail-form .progress .bar').width((i+j+1)*100.0/l + '%');
				    cnt+=j;
				    $('#sendmail-form .progress .bar').width(cnt*100.0/l + '%');
				    if(cnt==l)window.location.reload();

			        } else if (data.message) {
			          $('#sendmail-form .failure').html(data.message).show();
			        } else {
			          $('#sendmail-form .failure').html('Unknown: ' + textStatus).show();
			        }
			      },
			      error: function(jqXHR, textStatus, errorThrown){
			        $('#sendmail-form .failure').html('Error: ' + textStatus).show();
			      },
			      complete: function(){
			        // TODO unlock screen
			      }
			    });
		    }
		});
        } else if (data.message) {
          $('#sendmail-form .failure').html(data.message).show();
        } else {
          $('#sendmail-form .failure').html('Unknown: ' + textStatus).show();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $('#sendmail-form .failure').html('Error: ' + textStatus).show();
      },
      complete: function(){
        // TODO unlock screen
      }
    });
    return false;
  });

});
