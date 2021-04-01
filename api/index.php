<?php include('templates/header.php');?>
<section class="showcase">
  <div class="container">
    <div class="pb-2 mt-4 mb-2 border-bottom">
      <h2>Build Simple REST API with PHP and MySQL</h2>
    </div>
  <div class="row">       
    <div class="col-md-12 gedf-main">
    	<form method="post">
        <div class="row"> 
          <label for="name" style="padding-left: 18px;">http://localhost/ta/build-simple-rest-api-with-php-mysql/student/read/{student_id}</label>
          <div class="col-sm-9">
            <input type="text" name="url" value="http://localhost/ta/build-simple-rest-api-with-php-mysql/student/read/" class="form-control" required/>
          </div>
          <div class="col-sm-3 text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md" value="submit">Make API Request</button>
          </div>
        </div>
      </form>
	<?php
	if(isset($_POST['submit']))	{
		$url = $_POST['url'];				
		$client = curl_init($url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($client);		
		$result = json_decode($response);	
		echo "<pre>";
		print_r($result);	
		echo "</pre>";	
	}
	?>
     
    </div>       
  </div>
  </div>
</section>
<?php include('templates/footer.php');?>