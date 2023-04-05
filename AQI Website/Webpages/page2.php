<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<style>
		.my-card {
					border-radius:15px;
					background-color:#0fa75abf;
					margin-top:15px;
					margin-bottom:15px;
					padding:15px;
					border-bottom:2px;
					border-bottom-color:#;
					box-shadow:0 10px 15px rgb(18,235,135,0.15);
					
					}
		.my-widget1-r {
						border-radius:10px;
						background-color:#12fa8f96;
						margin-left:10px;
						padding:10px;
						width:45%;
						}	
        .my-widget1-l {
						border-radius:10px;
						background-color:#12fa8f96;
						margin-right:10px;
						padding:10px;
						width:45%;
						}
		.my-widget2 {
						border-radius:10px;
						background-color:#12fa8f96;
						margin-right:10px;
						padding:10px;
						width:100%;
						}
		.my-widget3 {
						border-radius:10px;
						background-color:#fcebebe0;
						margin:15px;
						padding:0px;
						width:150px;
						box-shadow:0 10px 15px rgb(18,35,25,0.15);
						}
		.my-scroll {
						overflow-x:scroll;
						overflow-y:hidden;
						padding:0px;
						width:100%;
						}	
		.graph 		{
						background-color:#fff;
						}						
	</style>
	<title>Air Pollution</title>
  </head>
  <body>	
    <?php
	    $handle=null;
			$parameter=null;
			$Year=null;
			$Month=null;
			$Day=null;
			$flag=null;
		if(!empty($_POST['_handle_']))
		{
			$handle=$_POST['_handle_'];
			$parameter=$_POST['Parameter'];
			$Year=$_POST['Year'];
			$Month=$_POST['Month'];
			$Day=0;
			$flag=0;
			if($_POST['_handle_'])
			{
				$Day=$_POST['Day'];
			}
			
			if(empty($parameter)||empty($Year)||empty($Month)||empty($Day))
			 {
				 $flag=1;
				if(empty($parameter))
				 {
				 $msg="! No parameter Selected *";}
					else
					 {
				if(empty($Year))
				 {
				 $msg="! No Year Selected *";}
					else
					 {
				if(empty($Month))
				 {
				 $msg="! No Month Selected *";}
					else
					{
				if($POST['_handle_'])
				 {
			 $msg="! No Day Selected *";}
			 else{$flag=0;}}}}}
		}
		else
		{
			$handle=-1;
            $parameter='AQI';
		}
	?>
	<?php
            date_default_timezone_set("Asia/Calcutta");
            $host="sql205.epizy.com";
            $duser="epiz_33711540";
            $dpaswd="a8CmhA1TPNTiMZ";
            $dname="epiz_33711540_IOT_db";

            $db=mysqli_connect($host,$duser,$dpaswd,$dname);
            if(!$db)
            {
                $msg="Unable to connect to database:";
            }
            else 
            {
                
            }

        ?>
	
	<div class="float-md-right  sticky-top" style="z-index:1021">		
		<div class="alert alert-danger alert-dismissible shadow m-2" >
			Air Quality Alert 
			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
				Open MESSAGE
			</button>
			<button type="button" class="close" data-dismiss="alert">&times; </button>
		</div>	
	</div>	

	<!-- The Heading-->
	<div class="container-fluid bg-dark ">
		<div class="container-lg p-3 bg-dark text-white ">
		  <h1>Air Quality Prediction</h1>
		  <p>Air Pollution monitoring and Forecasting Using IOT.</p>
		</div>	
	</div>
	
	<!-- The Header Navigation -->
	<div class="container-fluid bg-dark sticky-top shadow">
	<div class="container-lg bg-dark ">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
		  <ul class="navbar-nav mr-auto">
			<li class="nav-item ">
			  <a class="nav-link" href="/newpage1.php">Home</a>
			</li>
			<li class="nav-item active">
			  <a class="nav-link" href="/newpage2.php">Reports</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="/newpage3.php">About AQI</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link disabled" href="/aqi.apk">Download APP</a>
			</li>
		  </ul>
		</div>
		<form class="form-inline" action="/action_page.php">
			<input class="form-control mr-sm-2" type="text" placeholder="Search">
			<button class="btn btn-success" type="submit">Search</button>
		</form>
			
		</nav>
	</div>
	</div>
	
	<!-- Report Form-->
	<div class="container-fluid my-3 py-3 ">
		<div class="container-lg bg-light py-3 shadow">
			<div class="dropdown float-right">
				<button type="button" class="btn btn-primary dropdown-toggle"  style="min-width:100px"  data-toggle="dropdown">
					<?php if($handle==2)echo "Daily";else echo"Monthly";?>
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item"  data-toggle="tab" onClick="my_fn(this)" href="#monthly">Monthly</a>
					<a class="dropdown-item"  data-toggle="tab" onClick="my_fn(this)" href="#daily"> Daily </a> 
				</div>
			</div>
			
			<div class="tab-content">
				<div  <?php echo "class=\"tab-pane "; if($handle==-1||$handle==1)echo "active"; echo"\"";?> id="monthly">
					
					<h4>Monthly Data</h4>
					
					<form action="/newpage2.php" method="post" class="row">
					
						<select name="Parameter" class="custom-select col-sm-2 m-2" >
							<option <?php if($handle==-1)echo "selected";?> disabled>Select Parameter<?php if(!empty($_POST['_handle_']))echo"-ht";?></option>
							<option <?php if($parameter=="PM25")echo "selected";?> value="PM25">PM<sub>2.5</sub></option>
							<option <?php if($parameter=="PM10")echo "selected";?>  value="PM10">PM<sub>1.0</sub></option>
							<option <?php if($parameter=="CO")echo "selected";?>  value="CO">CO</option>
							<option <?php if($parameter=="NO2")echo "selected";?>  value="NO2">NO<sub>2</sub></option>
							<option <?php if($parameter=="O3")echo "selected";?>  value="O3">O<sub>3</sub></option>
							<option <?php if($parameter=="NH3")echo "selected";?>  value="NH3">NH<sub>3</sub></option>
							<option <?php if($parameter=="SO2")echo "selected";?>  value="SO2">SO<sub>2</sub></option>
							<option <?php if($parameter=="TEMPRATURE")echo "selected";?>  value="TEMPRATURE">Temprature</option>
							<option <?php if($parameter=="PRESSURE")echo "selected";?>  value="PRESSURE">Pressure</option>
							<option <?php if($parameter=="HUMIDITY")echo "selected";?>  value="HUMIDITY">Humidity</option>
							<option <?php if($parameter=="AQI")echo "selected";?>  value="AQI">AQI</option>
						</select>
						<select name="Year" class="custom-select col-sm-2 m-2">
							<option  <?php if($handle==-1)echo "selected";?> disabled>Select Year</option>
							<option  <?php if($Year=="2020")echo "selected";?> value="2020">2020</option>
							<option <?php if($Year=="2021")echo "selected";?> value="2021">2021</option>
							<option value="2022" disabled>2022</option>
						</select>
						<select name="Month" class="custom-select col-sm-2 m-2">
							<option  <?php if($handle==-1)echo "selected";?> disabled>Select Month</option>
							<option  <?php if($Month==1)echo "selected";?> value=1>Jan</option>
							<option <?php if($Month==2)echo "selected";?>  value=2>Feb</option>
							<option <?php if($Month==3)echo "selected";?>  value=3>Mar</option>
							<option <?php if($Month==4)echo "selected";?>  value=4>Apr</option>
							<option <?php if($Month==5)echo "selected";?>  value=5>May</option>
							<option <?php if($Month==6)echo "selected";?>  value=6>Jun</option>
							<option <?php if($Month==7)echo "selected";?>  value=7>Jul</option>
							<option <?php if($Month==8)echo "selected";?>  value=8>Aug</option>
							<option <?php if($Month==9)echo "selected";?>  value=9>Sep</option>
							<option <?php if($Month==10)echo "selected";?>  value=10>Oct</option>
							<option <?php if($Month==11)echo "selected";?>  value=11>Nov</option>
							<option <?php if($Month==12)echo "selected";?>  value=12>Dec</option>
						</select>
					    <input type='hidden' name='_handle_' value='1' />
						<button type="submit" class="button btn-primary m-2 px-2" >Get Report</button>
				
			        </form>
		            <?php if($flag && $handle==1)echo '<p class="mx-3 text-warning">'.$msg.'</p>' ;?>
				</div>	
			
				<div  <?php echo "class=\"tab-pane "; if($handle==2)echo "active"; echo"\"";?> id="daily">
					
					<h4>Day-wise Data</h4>
					
					
					<form action="/newpage2.php"  method="post" class="row">
					
					<select name="Parameter" class="custom-select col-sm-2 m-2" >
							<option <?php if($handle==-1)echo "selected";?> disabled>Select Parameter</option>
							<option <?php if($parameter=="PM25")echo "selected";?> value="PM25">PM<sub>2.5</sub></option>
							<option <?php if($parameter=="PM10")echo "selected";?>  value="PM10">PM<sub>1.0</sub></option>
							<option <?php if($parameter=="CO")echo "selected";?>  value="CO">CO</option>
							<option <?php if($parameter=="NO2")echo "selected";?>  value="NO2">NO<sub>2</sub></option>
							<option <?php if($parameter=="O3")echo "selected";?>  value="O3">O<sub>3</sub></option>
							<option <?php if($parameter=="NH3")echo "selected";?>  value="NH3">NH<sub>3</sub></option>
							<option <?php if($parameter=="SO2")echo "selected";?>  value="SO2">SO<sub>2</sub></option>
							<option <?php if($parameter=="TEMPRATURE")echo "selected";?>  value="TEMPRATURE">Temprature</option>
							<option <?php if($parameter=="PRESSURE")echo "selected";?>  value="PRESSURE">Pressure</option>
							<option <?php if($parameter=="HUMIDITY")echo "selected";?>  value="HUMIDITY">Humidity</option>
							<option <?php if($parameter=="AQI")echo "selected";?>  value="AQI">AQI</option>
						</select>
						<select name="Year" class="custom-select col-sm-2 m-2" id="select_Y">
							<option  <?php if($handle==-1)echo "selected";?> disabled>Select Year</option>
							<option  <?php if($Year=="2020")echo "selected";?> value="2020">2020</option>
							<option <?php if($Year=="2021")echo "selected";?> value="2021">2021</option>
							<option value="2022" disabled>2022</option>
						</select>
						<select name="Month" class="custom-select col-sm-2 m-2" id="select_M">
							<option  <?php if($handle==-1)echo "selected";?> disabled>Select Month</option>
							<option  <?php if($Month==1)echo "selected";?> value=1>Jan</option>
							<option <?php if($Month==2)echo "selected";?>  value=2>Feb</option>
							<option <?php if($Month==3)echo "selected";?>  value=3>Mar</option>
							<option <?php if($Month==4)echo "selected";?>  value=4>Apr</option>
							<option <?php if($Month==5)echo "selected";?>  value=5>May</option>
							<option <?php if($Month==6)echo "selected";?>  value=6>Jun</option>
							<option <?php if($Month==7)echo "selected";?>  value=7>Jul</option>
							<option <?php if($Month==8)echo "selected";?>  value=8>Aug</option>
							<option <?php if($Month==9)echo "selected";?>  value=9>Sep</option>
							<option <?php if($Month==10)echo "selected";?>  value=10>Oct</option>
							<option <?php if($Month==11)echo "selected";?>  value=11>Nov</option>
							<option <?php if($Month==12)echo "selected";?>  value=12>Dec</option>
						</select>
					   
						<select name="Day" class="custom-select col-sm-2 m-2" id="select_D">
							<option <?php if($handle==-1)echo "selected";?>  disabled>Select Date</option>
							<?php 
								if($handle==2 &&flag==0)
								{
									for ($i=1;$i<30;$i++)
									{
										echo "<option value=$i";
										if($Day==$i)echo" selected";
										echo ">$i</option>";
									}
								}
								
							?>
						</select>
						<input type='hidden' name='_handle_' value='2' />
						<button type="submit" class="button btn-primary m-2 px-2" >Get Report</button>
				
			        </form>
					<?php if($flag && $handle==2)echo '<p class="mx-3 text-warning">'.$msg.'</p>' ;?>
					
				</div>
			</div>
			
		</div>
	</div>

	<!-- AQI History-->
	<div class="">
		<div class="container-lg p-3 my-3" style="background-color:#8cc5ed94">
			
			<div class="mb-3">
				<h2 ><?php echo"$parameter (Report) "?></h2>
			</div>
			
			<div class="" id="poll_hr">
				
				<h4>Historical Data</h4>
				
				<div class="my-scroll mb-3">
					<div class="graph" id="colchart">
						
						
					</div>	
				</div>
				
			</div>
		</div>
	</div>	

   </body>
   
    <script>
		function my_fn(at)
		{	$(at).parent().children("a").removeClass("active");
			$(at).parent().parent().children("button").text($(at).text());
		}
		function daysInMonth(month, year) 
		{
			return new Date(year, month, 0).getDate();
		}
		el_month = document.getElementById("select_M");
		el_day = document.getElementById("select_D");
		el_year  =document.getElementById("select_Y");
		

		el_year.addEventListener('change', function populate_child(e){
			el_day.innerHTML = '<option>Select Date</option>';
			var y = e.target.value;
			var m1 = el_month.selectedIndex;
			
			if(m1!=0)
			{
				var m = el_month.options[el_month.selectedIndex].value;
				d = daysInMonth(m,y);
				
				for (i = 1; i <= d; i++) {
					el_day.innerHTML = el_day.innerHTML + '<option value='+i+'>'+i+'</option>';
				}
			}
			
		});
		el_month.addEventListener('change', function populate_child(e){
			el_day.innerHTML = '<option>Select Date</option>';
			var m = e.target.value;
			var y = el_year.options[el_year.selectedIndex].value;
			d = daysInMonth(m,y);
			
			for (i = 1; i <= d; i++) {
				el_day.innerHTML = el_day.innerHTML + '<option value='+i+'>'+i+'</option>';
			}
			
		});	
         
    </script>

 
<!-- The Pollution chart-->

	<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        //DAILY
        
        // Draw the chart and set the chart values
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
                
                <?php
					if($handle==1 && $flag==0)   //Daily
					{
						echo"['Date', '$parameter', { role: 'style' } ]";
						$qry="SELECT 	`Date`,ROUND(AVG(`$parameter`),0)`$parameter`
								FROM `ap`
								WHERE YEAR(Date)=$Year AND Month(Date)=$Month
								GROUP BY  Date
								ORDER BY Date DESC ;";
					}
                    else {
					if($handle==2 && $flag==0)   //Hourly
					{
						echo"['Hour', '$parameter', { role: 'style' } ]";
						$qry="SELECT 	`Date`,`Time`,ROUND(AVG(`$parameter`),0)`$parameter`
                            FROM `ap`
							WHERE YEAR(Date)=$Year AND Month(Date)=$Month AND DAY(Date)=$Day
                            GROUP BY hour(Time),Date
                            ORDER BY Date DESC,Time DESC LIMIT 24;";
					}
                    else
                    {
                        echo '["Date", "$parameter", { role: "style" } ]';
                        $qry="SELECT 	`Date`,ROUND(AVG(`$parameter`),0)`$parameter`
                            FROM `ap`	
                            GROUP BY Date 
                            ORDER BY Date DESC LIMIT 24;";
                    }
                    }
					
					
                    if($result=mysqli_query($db,$qry) )
                    {
                        while($data=mysqli_fetch_array($result))
                        {    
                             if($handle==1)
                             {
                                 echo ',["'.date("j/n",strtotime($data['Date'])).'",'.$data[$parameter].',"';echo getAqiColor($data[$parameter]);echo '"]';
                             }
							 if($handle==2)
                             {
                                 echo ',["'.date("H:i A",strtotime($data['Time'])).'",'.$data[$parameter].',"';echo getAqiColor($data[$parameter]);echo '"]';
                             }
                             if($handle==-1)
                             {
                                 echo ',["'.date("j/n",strtotime($data['Date'])).'",'.$data[$parameter].',"';echo getAqiColor($data[$parameter]);echo '"]';
                             }
                             
                            
                        }
                        
                    }
                    else
                    {   
                        echo ',["21/11", 8.94, "#b87333"],
                            ["22/11", 10.49, "silver"],
                            ["23/11", 19.30, "gold"],
                            ["24/11", 21.45, "color: #e5e4e2"]';
                    }
        ?>
            ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                        { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                        2]);

        var options = {
            <?php if ($handle==2)echo "title: '$parameter Details ($Year-$Month-$Day)',";
                else echo "title: '$parameter Details ($Year-$Month)',"; ?>
            width: 1500,
            height: 300,
            hAxis : {
                    textPosition :"out",
                    direction:-1,
                    //slantedText :"True",  
                    title:"Date"},
            bar: {groupWidth: "80%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("colchart"));
        chart.draw(view, options);
        }
	</script>
     
    <?php 
        function getAqiColor(float $aqi){
            if($aqi<50){
                echo '#08f610';
            }
            elseif($aqi<100){
                echo '#dcf608';
            }
            elseif($aqi<150){
                echo '#ffe52b';
            }
            elseif($aqi<200){
                echo '#fcac34';
            }
            elseif($aqi<300){
                echo '#fc5034';
            }
            elseif($aqi<500){
                echo '#c60f0f';
            }
            else{
                echo '#615f5e';
            }
        }
        
        function getAQ(float $aqi){
            if($aqi<50){
                return 'Good';
            }
            elseif($aqi<100){
                return 'Satisfactory';
            }
            elseif($aqi<150){
                return 'Moderate';
            }
            elseif($aqi<200){
                return 'Poor';
            }
            elseif($aqi<300){
                return 'Very Poor';
            }
            elseif($aqi<500){
                return 'Severe';
            }
            else{
                return 'Inadequate';
            }
        }
    ?>
	
	</html>
