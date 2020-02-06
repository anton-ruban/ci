<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<style type="text/css">
  body{
    background: -webkit-linear-gradient(left, #0072ff, #00c6ff);
}
.contact-form{
    background: #fff;
    margin-top: 10%;
    margin-bottom: 5%;
    width: 70%;
}
.contact-form .form-control{
    border-radius:1rem;
}
.contact-image{
    text-align: center;
}
.contact-image img{
    border-radius: 6rem;
    width: 11%;
    margin-top: -3%;
    transform: rotate(29deg);
}
.contact-form form{
    padding: 14%;
}
.contact-form form .row{
    margin-bottom: -7%;
}
.contact-form h3{
    margin-bottom: 8%;
    margin-top: -10%;
    text-align: center;
    color: #0062cc;
}
.contact-form .btnContact {
    width: 50%;
    border: none;
    border-radius: 1rem;
    padding: 1.5%;
    background: #dc3545;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
}
.btnContactSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    color: #fff;
    background-color: #0062cc;
    border: none;
    cursor: pointer;
}
.error{
  color:red;
}
</style>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
 
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
 
<div class="container contact-form">
  <form method="post" id="getInTouchForm">
      <div class="alert alert-success d-none" id="msg_div">
          <span id="res_message"></span>
      </div><br>
      <h3>SMTP mail test on TrackStreet</h3>
     <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label>Recipient Email Address</label>
                  <input type="email" name="email" class="form-control" placeholder="Recipient Email Address *" value="" />
              </div>
              <div class="form-group">
                <label>Email Subject</label>
                  <input type="text" name="subject" class="form-control" placeholder="Email Subject *" value="" />
              </div>
              <div class="form-group">
                  <input type="submit" name="btnSubmit" id="get_in_touch_btn" class="btnContact" value="Send" />
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Email Message Body</label>
                  <textarea name="message" class="form-control" placeholder="Your Message *" style="width: 100%; height: 125px;"></textarea>
              </div>
          </div>
      </div>
  </form>
</div>
</body>
 
<script type="text/javascript">
  var BASE_URL = "<?php echo base_url(); ?>";
     if ($("#getInTouchForm").length > 0) {
     $("#getInTouchForm").validate({
          rules: {
            email: {
              required: true,
            },
            subject: {
                required: true,
              },
            message: {
              required: true,
            }
          },
           messages: {
              email: {
                required: 'Please enter email address',
              },
              subject: {
                required: 'Please enter email subject',
              },
              message: {
                required: 'Please enter email message',
              }
              
            },
          submitHandler: function (form) {
            var oldval = $('#get_in_touch_btn').val();
            $('#get_in_touch_btn').prop('disabled', true);
            $('#get_in_touch_btn').val('Submitting..');
              $.ajax({
                  type: "POST",
                  url: "email/send_mail",
                  data: $(form).serialize(),
                  dataType: 'json'
              }).done(function (response) {
                  if (response.success == true) {
                      $('#get_in_touch_btn').val(oldval);
                      $('#get_in_touch_btn').prop('disabled', false);
 
                      $('#res_message').html(response.msg);
                      $('#res_message').show();
                      $('#msg_div').removeClass('d-none');
 
                      document.getElementById("getInTouchForm").reset(); 
                      setTimeout(function(){
                        $('#res_message').hide();
                        $('#msg_div').hide();
                      },10000);
                   
                  } else {
                      $('#get_in_touch_btn').val(oldval);
                      $('#get_in_touch_btn').prop('disabled', false);
                     
                  }
              });
              return false;
          }
 
      });
 
  }
</script>
</html>