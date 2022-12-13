<?php
function generate_pw() {
  
  // Set random length for password
  $password_length = rand(8, 16);
  $pw = '';
  for($i = 0; $i < $password_length; $i++) {
    $pw .= chr(rand(32, 126));
  }
  return $pw;
}
// Código de https://www.codespeedy.com/how-to-generate-random-password-in-php/#:~:text=php%20function%20generate_pw()%20%7B%20%2F%2F,return%20the%20randomly%20generated%20password.
?>
