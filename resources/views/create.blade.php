<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="/admin/survey/create" method="POST">
    <label for="name">題目:</label><br>
    <input type="text"  name="name" value="Topic1"><br><br>
    <label for="start_text">歡迎:</label><br>
    <input type="text"  name="start_text" value="Welcome"><br><br>
    <label for="end_text">謝謝：</label><br>
    <input type="text"  name="end_text" value="ThankYou"><br><br>
  <input type="submit" value="Submit">
</form>


</body>
</html>
