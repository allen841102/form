<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="/form" method="POST">
  <label for="fname">First name:</label><br>
  <input type="text"  name="fname" value="John"><br>
  <label for="lname">Last name:</label><br>
  <input type="text"  name="lname" value="Doe"><br><br>
  <label for="lname">Email:</label><br>
  <input type="text" name="email" value="test@email" ><br><br>
  <input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>
