<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
       <head>
               <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
               <title>Books</title>
               <style type="text/css">
               body {text-align: center; padding-top: 20%;}
               body {
                       font-family: "Myriad Pro";
               }
               form label {
                       display: none;
               }
               form input {
                       border: 2px solid #999;
                       -webkit-border-radius: 6px;
                       -moz-border-radius: 6px;
                       height: 2em;
                       outline: none;
               }
               </style>
       </head>
       <body>
               <h1>ButlerBooks</h1>
               <form id="form" name="form" method="post" action="search.php">
               <label id="book_label" for="book">Book:</label>
               <input type="text" name="book" id="book"/>
               <button type="submit">Go</button>
               </form>
       </body>
</html>
