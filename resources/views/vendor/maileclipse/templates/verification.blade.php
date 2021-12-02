<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Neopolitan Confirm Email</title>
  <!-- Designed by https://github.com/kaytcat -->
  <!-- Robot header image designed by Freepik.com -->

  <style type="text/css">
  @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

  /* Take care of image borders and formatting */

  img {
    max-width: 600px;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
  }

  a {
    text-decoration: none;
    border: 0;
    outline: none;
    color: #bbbbbb;
  }

  a img {
    border: none;
  }

  /* General styling */

  td, h1, h2, h3  {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 400;
  }

  td {
    text-align: center;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #37302d;
    background: #ffffff;
    font-size: 16px;
  }

   table {
    border-collapse: collapse !important;
  }

  .headline {
    color: #ffffff;
    font-size: 36px;
  }

 .force-full-width {
  width: 100% !important;
 }

 .force-width-80 {
  width: 80% !important;
 }




  </style>

  <style type="text/css" media="screen">
      @media screen {
         /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
        td, h1, h2, h3 {
          font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
        }
      }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class="w320"] {
        width: 320px !important;
      }

      td[class="mobile-block"] {
        width: 100% !important;
        display: block !important;
      }


    }
  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table class="force-full-width" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td align="center" valign="top" bgcolor="#ffffff" width="100%"><center>
<table class="w320" style="margin: 0 auto;" width="600" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" valign="top">
<table class="force-full-width" style="margin: 0 auto;" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-size: 30px; text-align: center;"><br />Alteo<br /><br /></td>
</tr>
</tbody>
</table>
<table class="force-full-width" style="margin: 0 auto;" cellspacing="0" cellpadding="0" bgcolor="#4dbfbf">
<tbody>
<tr>
<td><br /><img src="https://www.filepicker.io/api/file/carctJpuT0exMaN8WUYQ" alt="robot picture" width="224" height="240" /></td>
</tr>
<tr>
<td class="headline">{{trans('translate.verify_your_account') }}</td>
</tr>
<tr>
<td><center>
<table style="margin: 0px auto; width: 58.5%;" width="60%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="color: #187272; width: 100%;"><br />{{trans('translate.thanks_for_creating_account') }} <br /><br /></td>
</tr>
</tbody>
</table>
</center></td>
</tr>
<tr>
<td>
<div>
  <?php $locale = App::getLocale();  ?>
  {{trans('translate.please_follow_the') }}
  <a style="background-color: #178f8f; border-radius: 4px; color: #ffffff; display: inline-block; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 50px; text-align: center; text-decoration: none; width: 200px; -webkit-text-size-adjust: none;" href="{{ URL::to($locale.'/register/verify/' . $confirmation_code) }}"> link </a> {{trans('translate.to_verify_your_account') }}
  <!-- [if mso]>
                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f">
                          <w:anchorlock/>
                          <center>
                        <![endif]
  <a style="background-color: #178f8f; border-radius: 4px; color: #ffffff; display: inline-block; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 50px; text-align: center; text-decoration: none; width: 200px; -webkit-text-size-adjust: none;" href="http://127.0.0.1">My Order</a> <!-- [if mso]>
   
  </center>
                        </v:roundrect>
                      <![endif]--></div>
<br /><br /></td>
</tr>
</tbody>
</table>
<table class="force-full-width" style="margin: 0 auto;" cellspacing="0" cellpadding="0" bgcolor="#414141">
<tbody>
<tr>
<td style="background-color: #414141;"><br /><br /><img src="https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4" alt="google+" /> <img src="https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt" alt="facebook" /> <img src="https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe" alt="twitter" /> <br /><br /></td>
</tr>
<tr>
<td style="color: #bbbbbb; font-size: 12px;"><a href="#">View in browser</a> | <a href="#">Unsubscribe</a> | <a href="#">Contact</a> <br /><br /></td>
</tr>
<tr>
<td style="color: #bbbbbb; font-size: 12px;">&copy; 2021All Rights Reserved <br /><br /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</center></td>
</tr>
</tbody>
</table>
</body>
</html>