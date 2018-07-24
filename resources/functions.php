
<?php


function set_message($msg){

	if(!empty($msg)){

		$_SESSION['message']=$msg;		
	}

	else
	{
		$msg="";
	}
}

 function display_message()
 {
 	if(isset($_SESSION['message']))
 	{
 		echo $_SESSION['message'];
 		unset($_SESSION['message']);
 	}
 }


function redirect ($location)
{
	header("Location: $location");
	exit;
}

function query1($sql)
{
	global $connection;
	return mysqli_query($connection, $sql);
}


function confirm($result)
{
	global $connection;

	if(!$result){
		die("QUERY FAILED" . mysqli_error($connection));
	}
}


function escape_string($string)
{
	global $connection;
	 return mysqli_real_escape_string($connection, $string);

}

function fetch_array($result)
{
	return mysqli_fetch_array($result);
}


// get products

function get_products(){

	$query = query1("SELECT * fROM products");

    while ($row= fetch_array($query)) {         

    	$product = <<<DELIMETER


                <!-- Php code starts from here  --> 	

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                          <a href="item.php?id={$row['product_id']}"> <img src="{$row['product_image']}" alt=""> </a>
                            <div class="caption">
                                <h4 class="pull-right">{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                                 <a class="btn btn-primary"  href="cart.php?add={$row['product_id']}">Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
DELIMETER;

echo $product;
} 	

}





function get_products_in_cat_page(){

	$query = query1("SELECT * fROM products WHERE product_category_id = ". escape_string($_GET['id'])."");

    while ($row= fetch_array($query)) {         

    	$product = <<<DELIMETER

 <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;

echo $product;
} 	

}


function get_products_in_shop_page(){

	$query = query1("SELECT * fROM products");

    while ($row= fetch_array($query)) {         

    	$product = <<<DELIMETER

 <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;

echo $product;
} 	

}


function Send_message()
{
if(isset($_POST['submit'])){

	$to= "parvez0011@gmail.com";
	$from_name= $_POST['name'];
	$subject= $_POST['subject'];
	$from_email= $_POST['email'];
	$message= $_POST['message'];

	$header= "From:{$from_name} {from_email}";

	$result= mail($to, $subject, $message, $header);

	if(!$result)
	{
		set_message("Sorry message cant be sent");
		redirect("contact.php");
	}

	else{
		set_message("message has been sent");
		redirect("contact.php");
	}

}
}


function login_user(){

if(isset($_POST['submit'])){

$username = escape_string($_POST['username']);
$password = escape_string($_POST['password']);

$query = query1("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password }' ");
confirm($query);

if(mysqli_num_rows($query) == 0) {

set_message("Your Password or Username are wrong");
redirect("login.php");


} else {

$_SESSION['username'] = $username;
redirect("admin");

         }



    }
}
















function get_categories(){

	$query = query1("SELECT * fROM categories");

    while ($row= fetch_array($query)) {         

    	$category_link = <<<DELIMETER

<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row ['cat_title']}</a>

DELIMETER;

echo $category_link;
} 	

}



function myprice(){

                $query = "SELECT * FROM products";
                
                $send_query = mysqli_query($connection,$query);

               while($row= mysqli_fetch_array($send_query)) {

                    echo $row['product_price'];                  

                } 
            }
       
?>
