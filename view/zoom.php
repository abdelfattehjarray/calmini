

<?php
include('../config.php');

include('config.php');
include('api.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $topic = $_POST['topic'];
  $start_date = $_POST['start_date'];
  $duration = $_POST['duration'];
  $password = $_POST['password'];

  // Create Zoom meeting
  $arr['topic'] = $topic;
  $arr['start_date'] = $start_date;
  $arr['duration'] = $duration;
  $arr['password'] = $password;
  $arr['type'] = '2';

  $result = createMeeting($arr);

  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--consultation en ligne -->
    <style>
  form {
  margin: 20px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px #ccc;
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="datetime-local"],
input[type="number"],
input[type="email"] {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  width: 100%;
  margin-bottom: 20px;
}

input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #0069d9;
}

button[type="submit"] {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #0069d9;
}

  </style>

<form method="POST">
  <label for="topic">Topic:</label>
  <input type="text" name="topic" id="topic" required><br>

  <label for="start_date">Start Date:</label>
  <input type="datetime-local" name="start_date" id="start_date" required><br>

  <label for="duration">Duration (in minutes):</label>
  <input type="number" name="duration" id="duration" min="1" max="240" required><br>

  <label for="password">Password:</label>
  <input type="text" name="password" id="password" required><br>

  <input type="submit" value="Create Meeting">
</form>
<form class="" action="sendurl.php" method="post">
        Email <input type="email" name='email' id="email" value=""> <br>
        Subject <input type="text" name="subject" value="Consultation"><br>
        Message <input type="text" name="message" value="<?php echo isset($result->join_url) ? $result->join_url : '' ;?>"readonly> <br>
        <button type="submit" name="send">send</button>
  </form>
 
<!--fin consultation en ligne -->
</body>
</html>