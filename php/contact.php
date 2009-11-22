<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>ButlerBooks | Email Sent</title>
    </head>
  <body>
   <?php
   $seller = $_POST['seller'];
   $buyer = $_POST['buyer'];
   $book = $_POST['book_title'];
   $cost = $_POST['book_cost'];
   
   $seller_to = $seller.'@columbia.edu';
   $buyer_to = $buyer.'@columbia.edu';
   $seller_subject = 'ButlerBooks.com: '.$book.' has an interested buyer!';
   $buyer_subject = 'ButlerBooks.com: You\'ve bought '.$book;
   $seller_message = 'Buyer (.'$buyer.'@columbia.edu) wants to buy your book, '.$book.', (for $'.$cost.')';
   $buyer_message = 'The seller (.'$seller.'@columbia.edu) has been contacted. Feel free to contact for more info about buying '.$book.' (for $'.$cost.')';

    $headers = 'From: qoobster@gmail.com '."\r\n" .
	     'X-Mailer: PHP/' . phpversion();

     mail($seller_to, $seller_subject, $seller_message, $headers);
     mail($buyer_to, $buyer_subject, $buyer_message, $headers);
   ?>
</body>
</html>
