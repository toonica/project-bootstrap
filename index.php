    <html>
    <body>

        <form action="index.php" method="post" enctype="multipart/form-data">
            Your Photo: <input type="file" name="photo" size="25" />
            <input type="submit" name="submit" value="Submit" />
        </form>

    </body>
    </html>

    <?php

    //if they DID upload a file...
    if($_FILES['photo']['name'])
    {
    //if no errors...
    if(!$_FILES['photo']['error'])
    {
      $valid_file = true;
        $temp = explode(".", $_FILES["photo"]["name"]);
        $extension = end($temp);
    //now is the time to modify the future file name and validate the file
    $new_file_name = time() . '.' .  $extension; //rename file
    if($_FILES['photo']['size'] > (1024000)) //can't be larger than 1 MB
    {
    $valid_file = false;
    echo 'Oops!  Your file\'s size is to large.';
    }

    //if the file has passed the test
    if($valid_file)
    {
    //move it to where we want it to be
    move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/'.$new_file_name);
    echo 'Congratulations!  Your file was accepted.';
    }
    }
    //if there is an error...
    else
    {
    //set that to be the returned message
    echo 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];

    }
        echo '<img src="uploads/' . $new_file_name . '">';
    }

