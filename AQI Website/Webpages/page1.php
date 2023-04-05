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
        <!-- The DATABASE Connection -->
        <?php
            date_default_timezone_set("Asia/Calcutta");
            $host="sql205.epizy.com";
            $duser="epiz_33711540";
            $dpaswd="a8CmhA1TPNTiMZ";
            $dname="epiz_33711540_IOT_db";

            $tm	=date("H:i:s",time());
            $day =date("d",time());
            $month =date("m",time());
            $year =date("y",time());
            $hr = date("H",time());
            $min = date("i",time());
            $dayList = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];


            $pm25  = 0;
            $pm10  = 0;
            $co   = 0;
            $no2   = 0;
            $o3  = 0;
            $nh3  = 0;
            $so2  = 0;
            $temp = 0;
            $press= 0;
            $alt  = 0;
            $humid= 0;
            $lt   = 0;
            $ln	  = 0;
            $AQI  = 0;


            $db=mysqli_connect($host,$duser,$dpaswd,$dname);
            if(!$db)
            {
                $msg="Unable to connect to database:";
            }
            else
            {
                $qry="SELECT * FROM ap ORDER BY sno DESC LIMIT 1;";
                        if($result=mysqli_query($db,$qry))
                        {
                            $data=mysqli_fetch_array($result);
                            //$tm   = date("H:i A",strtotime($data['Time']));
                            $pm25  = $data['PM25'];   	//NH3,NO,CO2
                            $pm10  = $data['PM10']; 	//LPG
                            $co   = $data['CO']; 	//CO
                            $no2   = $data['NO2']; //SMOKE
                            $o3  = $data['O3']; 		//CH4
                            $nh3  = $data['NH3']; 		//CO
                            $so2  = $data['SO2']; 		//H2
                            $temp = $data['TEMPRATURE'];
                            $press= $data['PRESSURE'];
                            $alt  = $data['ALTITUDE'];
                            $humid= $data['HUMIDITY'];
                            $lt   = $data['LATITUDE'];
                            $ln	  = $data['LONGITUDE'];		//PARTICULATE MATTER 2.5
                            $AQI  = $data['AQI'];
                        }
                        else
                        {
                            
                        }
            }

        ?>	
        
        <!-- The Message Alert -->
        <?php 
            if ($AQI>200)
                { echo'
                <div class="float-md-right  sticky-top" style="z-index:1021">		
                    <div class="alert alert-danger alert-dismissible shadow m-2" >
                        Air Quality Alert 
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
                            Open MESSAGE
                        </button>
                        <button type="button" class="close" data-dismiss="alert">&times; </button>
                    </div>	
                </div>';
                }
        ?>
    
        <!-- The Heading -->
        <div class="container-fluid bg-dark ">
            <div class="container-lg p-3 bg-dark text-white ">
            <h1>Air Quality Prediction</h1>
            <p>Air Pollution monitoring and Forecasting Using IOT.</p>
            </div>
        </div>

        <!-- The Menu Bar -->
        <div class="container-fluid bg-dark sticky-top shadow">
            <div class="container-lg bg-dark ">
                <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                            <a class="nav-link" href="/page1.php">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="/page2.php">Reports</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="/page3.php">About AQI</a>
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
        
        <!-- The Carousel Slide -->
        <div id="demo" class="carousel slide" data-ride="carousel" >

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner" style="height:500px">
                <div class="carousel-item active" align="center" style="height:100%; width:100%;">
                <img src="/Images/p41.jpg" alt="Los Angeles"  >
                <div class="carousel-caption">
                    <h3>Los Angeles</h3>
                    <p>We had such a great time in LA!</p>
                </div>
                </div>
                <div class="carousel-item " align="center"  style="height:100%; width:100%;">
                <img src="/Images/p22.jpg" alt="Chicago" >
                </div>
                <div class="carousel-item" align="center" style="height:100%; width:100%;">
                <img src="/Images/p51.jpg" alt="New York" >
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>


        <!-- The AQI Monitoring -->
        <div class="container-fluid">

            <div class="container-lg p-3 my-3 text-white" style="background-color:#0d1c68d9">
                
                <div class="text-center">
                    <h3>Location</h3>
                    <p>Ballabgarh,Faridabad</p>
                </div>
                <div class="text-center" >
                    time <?php echo "$tm"; ?>		
                </div>
                <div class="row" >
                    <div class="col-md-4">
                        <div class="my-card">
                            <div class="mb-3">
                            <h3>AQI</h3>
                            </div>
                            <div class="" >
                                <div class="" id="gauge" align="center"></div>
                                <div class="pb-1 mb-1 mx-auto" align="center" data-toggle="modal" data-target="#myModal" style="background-color:<?php getAqiColor($AQI);?>">
                                    <?php echo"".getAQ($AQI);?>
                                </div>
                            </div>
                            <div class="rounded-lg" id="piechart" style="overflow:hidden;"></div>
                            
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="my-card">
                            <div class="mb-3">
                                <h3>Pollutants</h3>
                            </div>
                            <div class="py-3" >
                                <div class="d-inline-block my-widget1-l shadow" >
                                
                                    <h4>PM 2.5</h4>
                                    <span><?PHP echo "$pm25"; ?></span>
                                    <span class="float-right">ug/m<sup>3</sup></span>
                                
                                    <div>
                                        <div class="ratio_bar float-left" style="background:#e5ff14; width:<?PHP echo "50"; ?>%;height:5px;"></div>							
                                        <div class="ratio-bar-bg" style="background:#999999;width:100%;height:5px;"></div>
                                    </div>
                                </div>
                                <div class="d-inline-block my-widget1-r shadow float-right " >
                                    <h4>PM 10</h4>
                                    <span><?PHP echo "$pm10"; ?></span>
                                    <span class="float-right">ug/m<sup>3</sup></span>
                                
                                    <div>
                                        <div class="ratio_bar float-left" style="background:#e5ff14; width:<?PHP echo "50"; ?>%;height:5px;"></div>							
                                        <div class="ratio-bar-bg" style="background:#999999;width:100%;height:5px;"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="py-3" >
                                <div class="d-inline-block my-widget1-l shadow" >
                                
                                    <h4>CO</h4>
                                    <span><?PHP echo "$co"; ?></span>
                                    <span class="float-right">ug/m<sup>3</sup></span>
                                
                                    <div>
                                        <div class="ratio_bar float-left" style="background:#e5ff14; width:<?PHP echo "50"; ?>%;height:5px;"></div>							
                                        <div class="ratio-bar-bg" style="background:#999999;width:100%;height:5px;"></div>
                                    </div>
                                </div>
                                <div class="d-inline-block my-widget1-r shadow float-right " >
                                    <h4>NO<sub>2</sub></h4>
                                    <span><?PHP echo "$no2"; ?></span>
                                    <span class="float-right">ug/m<sup>3</sup></span>						
                                    <div>
                                        <div class="ratio_bar float-left" style="background:#e5ff14; width:<?PHP echo "50"; ?>%;height:5px;"></div>							
                                        <div class="ratio-bar-bg" style="background:#999999;width:100%;height:5px;"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="py-3" >
                                <div class="d-inline-block my-widget1-l shadow" >
                                
                                    <h4>O<sub>3</sub></h4>
                                    <span><?PHP echo "$o3"; ?></span>
                                    <span class="float-right">ug/m<sup>3</sup></span>
                                
                                    <div>
                                        <div class="ratio_bar float-left" style="background:#e5ff14; width:<?PHP echo "50"; ?>%;height:5px;"></div>							
                                        <div class="ratio-bar-bg" style="background:#999999;width:100%;height:5px;"></div>
                                    </div>
                                </div>
                                <div class="d-inline-block my-widget1-r shadow float-right " >
                                    
                                    <h4>NH<sub>3</sub></h4>
                                    <span><?PHP echo "$nh3"; ?></span>
                                    <span class="float-right ">ug/m<sup>3</sup></span>
                                    
                                    <div>
                                        <div class="ratio_bar float-left" style="background:#e5ff14; width:<?PHP echo "50"; ?>%;height:5px;"></div>							
                                        <div class="ratio-bar-bg" style="background:#999999;width:100%;height:5px;"></div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="my-card">
                            <div class="mb-3">
                                <h3>Weather</h3>
                            </div>
                            <div class="py-3">
                                <div class="d-inline-block my-widget2 shadow" >								
                                    <div>								
                                        <h4>Temprature</h4>								
                                        <span><?PHP echo "$temp"; ?></span>
                                        <span class="float-right"><sup>*</sup>C</span>								
                                    </div>
                                    <div>
                                        <div class="ratio_bar float-left" style="background:#e5ff14; width:<?PHP echo "50"; ?>%;height:5px;"></div>							
                                        <div class="ratio-bar-bg" style="background:#999999;width:100%;height:5px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-3">
                                <div class="d-inline-block my-widget2 shadow" >								
                                    <div>								
                                        <h4>Pressure</h4>								
                                        <span><?PHP echo "$press"; ?></span>
                                        <span class="float-right">hPa</span>								
                                    </div>
                                    <div>
                                        <div class="ratio_bar float-left" style="background:#e5ff14; width:<?PHP echo "50"; ?>%;height:5px;"></div>							
                                        <div class="ratio-bar-bg" style="background:#999999;width:100%;height:5px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-3">
                                <div class="d-inline-block my-widget2 shadow" >								
                                    <div>								
                                        <h4>Humidity</h4>								
                                        <span><?PHP echo "$humid"; ?></span>
                                        <span class="float-right">%</span>								
                                    </div>
                                    <div>
                                        <div class="ratio_bar float-left" style="background:#e5ff14; width:<?PHP echo "50"; ?>%;height:5px;"></div>							
                                        <div class="ratio-bar-bg" style="background:#999999;width:100%;height:5px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>				
                </div> 
            </div>
        </div>

        <!-- Pollution History -->
        <div class="">
            <div class="container-lg p-3 my-3" style="background-color:#8cc5ed94">
                <div class="dropdown float-right">
                    <button type="button" class="btn btn-primary dropdown-toggle"  style="min-width:100px"  data-toggle="dropdown">
                        Hourly
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"  data-toggle="tab" onClick="my_fn(this)" href="#poll_hr">Hourly</a>
                        <a class="dropdown-item"  data-toggle="tab" onClick="my_fn(this)" href="#poll_dly"> Daily </a> 
                    </div>
                </div>
                <div class="mb-3">
                    <h2 >Pollution(AQI)</h2>
                </div>
                
                <div class="tab-content">
                    <div class="tab-pane  active" id="poll_hr">
                        
                        <h4>Historical Data</h4>
                        
                        <div class="my-scroll mb-3">
                            <div class="graph" id="poll_hr_colchart">
                                
                                
                            </div>	
                        </div>
                        <div class="mt-3">
                            <h3></h3>
                            <h4>Forecast</h4>
                        </div>
                        <div class="my-scroll" style="background-color:#1deb1966">
                            <div style="display:inline-flex">
                                <?php 
                                    $qry_phr="SELECT `Date`,`Day`,`AQI`,`TEMPRATURE` FROM `hr_4cast` ORDER BY Date;";
                                    if($result_phr=mysqli_query($db,$qry_phr))
                                    {
                                        while($data_phr=mysqli_fetch_array($result_phr))
                                        {
                                            echo '<div class="my-widget3 pb-1 text-center text-light">
                                                        <h4 class="bg-dark rounded">{$data_phr["Date"]}</h4>
                                                        <p style="background:#990099;margin-left:10px;margin-right:10px;">$data_phr["Day"]</p>
                                                        <p style="background:#000099;margin-left:10px;margin-right:10px;">Temp</p>
                                                        <p style="background:#990000;margin-left:10px;margin-right:10px;">AQI</p>
                                                        
                                                    </div>';
                                        }
                                        
                                    }
                                    else
                                    {
                                        $i=0;
                                        while($i<7)
                                        {
                                            if(($hr+$i)%24>11){$AmPm = "Pm";}else{$AmPm = "Am";}
                                            echo '<div class="my-widget3 pb-1 text-center text-light">
                                                        <h5 class="bg-dark rounded">'.$day.'/'.$month.'/'.$year.'</h5>
                                                        <p style="background:#990099;margin-left:10px;margin-right:10px;border-radius: 20px;">'.(($hr+$i)%12).':'.$min.' '.$AmPm.'</p>
                                                        <p style="background:#000099;margin-left:10px;margin-right:10px;">'.(253+rand(-2,2)).' ug/m<sup>3</p>
                                                        <p style="background:#990000;margin-left:10px;margin-right:10px;">AQI</p>
                                                        
                                                    </div>';
                                            $i++;        
                                        }
                                        
                                    }
                                ?>
                            </div>     
                        </div>
                    </div>	
                
                    <div class="tab-pane fade" id="poll_dly">
                        
                        <h4>Historical Data</h4>
                        
                        <div class="my-scroll mb-3">
                            <div class="graph" id="poll_dly_colchart">
                                
                                
                            </div>	
                        </div>
                        <div class="mt-3">
                            <h3></h3>
                            <h4>Forecast</h4>
                        </div>
                        <div class="my-scroll" style="background-color:#1deb1966">
                            <div style="display:inline-flex">
                                <?php 
                                    $qry_phr="SELECT `Date`,`Day`,`AQI`,`TEMPRATURE` FROM `hr_4cast` ORDER BY Date;";
                                    if($result_phr=mysqli_query($db,$qry_phr))
                                    {
                                        while($data_phr=mysqli_fetch_array($result_phr))
                                        {
                                            echo '<div class="my-widget3 pb-1 text-center text-light">
                                                        <h4 class="bg-dark rounded">{$data_phr["Date"]}</h4>
                                                        <p style="background:#990099;margin-left:10px;margin-right:10px;">$data_phr["Day"]</p>
                                                        <p style="background:#000099;margin-left:10px;margin-right:10px;">Temp</p>
                                                        <p style="background:#990000;margin-left:10px;margin-right:10px;">AQI</p>
                                                        
                                                    </div>';
                                        }
                                        
                                    }
                                    else
                                    {
                                        $i=0;
                                        while($i<7)
                                        {
                                            echo '<div class="my-widget3 pb-1 text-center text-light">
                                                        <h5 class="bg-dark rounded">'.($day+$i).'/'.$month.'/'.$year.'</h5>
                                                        <p style="background:#990099;margin-left:10px;margin-right:10px;">'.$dayList[$i].'</p>
                                                        <p style="background:#000099;margin-left:10px;margin-right:10px;">'.(253+rand(-5,5)).' ug/m<sup>3</sup></p>
                                                        <p style="background:#990000;margin-left:10px;margin-right:10px;">AQI</p>
                                                        
                                                    </div>';
                                            $i++;        
                                        }
                                        
                                    }
                                ?>    
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>	

        <!-- Temp History -->
        <div class="">
            <div class="container-lg p-3 my-3" style="background-color:#8c23ce94">
                <div class="dropdown float-right">
                    <button type="button" class="btn btn-primary dropdown-toggle"  style="min-width:100px"  data-toggle="dropdown">
                        Hourly
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"  data-toggle="tab" onClick="my_fn(this)" href="#temp_hr">Hourly</a>
                        <a class="dropdown-item"  data-toggle="tab" onClick="my_fn(this)" href="#temp_dly"> Daily </a> 
                    </div>
                </div>
                <div class="mb-3">
                    <h2 >Temprature</h2>
                </div>
                
                <div class="tab-content">
                    <div class="tab-pane  active" id="temp_hr">
                        
                        <h4>Historical Data</h4>
                        
                        <div class="my-scroll mb-3">
                            <div class="graph" id="temp_hr_colchart">
                                
                                
                            </div>	
                        </div>
                        <div class="mt-3">
                            <h3></h3>
                            <h4>Forecast</h4>
                        </div>
                        <div class="my-scroll" style="background-color:#e9c6ff9c">
                            <div style="display:inline-flex">
                                <?php 
                                    $qry_phr="SELECT `Date`,`Day`,`AQI`,`TEMPRATURE` FROM `hr_4cast` ORDER BY Date;";
                                    if($result_phr=mysqli_query($db,$qry_phr))
                                    {
                                        while($data_phr=mysqli_fetch_array($result_phr))
                                        {
                                            echo '<div class="my-widget3 pb-1 text-center text-light">
                                                        <h4 class="bg-dark rounded">{$data_phr["Date"]}</h4>
                                                        <p style="background:#990099;margin-left:10px;margin-right:10px;">$data_phr["Day"]</p>
                                                        <p style="background:#000099;margin-left:10px;margin-right:10px;">Temp</p>
                                                        <p style="background:#990000;margin-left:10px;margin-right:10px;">AQI</p>
                                                        
                                                    </div>';
                                        }
                                        
                                    }
                                    else
                                    {
                                        $i=0;
                                        while($i<7)
                                        {
                                            if(($hr+$i)%24>11){$AmPm = "Pm";}else{$AmPm = "Am";}
                                            echo '<div class="my-widget3 pb-1 text-center text-light">
                                                        <h5 class="bg-dark rounded">'.$day.'/'.$month.'/'.$year.'</h5>
                                                        <p style="background:#990099;margin-left:10px;margin-right:10px;border-radius: 20px;">'.(($hr+$i)%12).':'.$min.' '.$AmPm.'</p>
                                                        <p style="background:#000099;margin-left:10px;margin-right:10px;">'.(35.3+rand(-2,2)).' *C</p>
                                                        <p style="background:#990000;margin-left:10px;margin-right:10px;">Temp</p>
                                                        
                                                    </div>';
                                            $i++;        
                                        }
                                        
                                    }
                                ?>
                            </div>	
                        </div>
                    </div>	
                
                    <div class="tab-pane fade" id="temp_dly">
                        
                        <h4>Historical Data</h4>
                        
                        <div class="my-scroll mb-3">
                            <div class="graph" id="temp_dly_colchart">
                                
                                
                            </div>	
                        </div>
                        <div class="mt-3">
                            <h3></h3>
                            <h4>Forecast</h4>
                        </div>
                        <div class="my-scroll" style="background-color:#e9c6ff9c">
                            <div style="display:inline-flex">
                                <?php 
                                    $qry_phr="SELECT `Date`,`Day`,`AQI`,`TEMPRATURE` FROM `hr_4cast` ORDER BY Date;";
                                    if($result_phr=mysqli_query($db,$qry_phr))
                                    {
                                        while($data_phr=mysqli_fetch_array($result_phr))
                                        {
                                            echo '<div class="my-widget3 pb-1 text-center text-light">
                                                        <h4 class="bg-dark rounded">{$data_phr["Date"]}</h4>
                                                        <p style="background:#990099;margin-left:10px;margin-right:10px;">$data_phr["Day"]</p>
                                                        <p style="background:#000099;margin-left:10px;margin-right:10px;">Temp</p>
                                                        <p style="background:#990000;margin-left:10px;margin-right:10px;">AQI</p>
                                                        
                                                    </div>';
                                        }
                                        
                                    }
                                    else
                                    {
                                        $i=0;
                                        while($i<7)
                                        {
                                            echo '<div class="my-widget3 pb-1 text-center text-light">
                                                        <h5 class="bg-dark rounded">'.($day+$i).'/'.$month.'/'.$year.'</h5>
                                                        <p style="background:#990099;margin-left:10px;margin-right:10px;">'.$dayList[$i].'</p>
                                                        <p style="background:#000099;margin-left:10px;margin-right:10px;">'.(35.3+rand(-7,7)).' *C</p>
                                                        <p style="background:#990000;margin-left:10px;margin-right:10px;">Temp</p>
                                                        
                                                    </div>';
                                            $i++;        
                                        }
                                        
                                    }
                                ?>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>	

        <!-- Google Maps -->
        <div class="container-fluid bg-dark text-light">
            <div class="container-lg p-3 my-3">
                
                <div class="">
                    <h3>Google Maps</h3>
                    <p>AQI</p>
                </div>
                <div class="my-scroll">
                    <div class="graph" id="map_div">
                        
                        
                    </div>	
                </div>
            </div>	
        </div>
        
        <!-- Area Maps-->
        <div class="container-fluid bg-dark text-light">
            <div class="container-lg p-3 my-3">
                
                <div class="">
                    <h3>Google Maps</h3>
                    <p>AQI</p>
                </div>
                <div class="my-scroll">
                    <div class="graph" id="geochart-colors">
                        
                        
                    </div>	
                </div>
            </div>	
        </div>
  

        <?php        
                $modalQry="SELECT * FROM aqi_description where Level='".getAQ($AQI)."';";
                    if($modalResult=mysqli_query($db,$modalQry))
                    {
                        $modalData=mysqli_fetch_array($modalResult);
                    }  
                    
        ?>
        
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header" style="background-color:<?php getAqiColor($AQI);?>">
                        <h3 class="modal-title text-white" >Air Quality - <?php echo"".getAQ($AQI);?></h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <th>Description</td>
                                <td><?php echo $modalData['Description'];?></td>
                            </tr>
                            <tr>
                                <th>Who needs Concern</td>
                                <td><?php echo $modalData['Concern'];?></td>
                            </tr>
                            <tr>
                                <th>Health Effects</td>
                                <td><?php echo $modalData['Effects'];?></td>
                            </tr>
                            <tr>
                                <th>What to do</td>
                                <td><?php echo $modalData['Solution'];?></td>
                            </tr>
                        </table> 
                        
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer" style="background-color:<?php getAqiColor($AQI);?>">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

	</body>
   
    <script>function my_fn(at){	$(at).parent().children("a").removeClass("active");
								$(at).parent().parent().children("button").text($(at).text());
							}
	</script>
 
    <!-- The Gauge Chart -->
    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {'packages':['gauge']});
        google.charts.setOnLoadCallback(drawChart2);

        // Draw the chart and set the chart values
        function drawChart2() {
                    
        var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['AQI',<?php echo $AQI; ?>],
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {min:0,max:400,width: 400, height: 120,
                        redFrom: 250, redTo: 400,
                        yellowFrom:150, yellowTo: 250,
                        minorTicks: 10};

        // Display the chart inside the <div> element with id="gauge"
        var chart = new google.visualization.Gauge(document.getElementById('gauge'));
        chart.draw(data, options);
        }
    </script>
    
    <!-- The Pie Chart -->
    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Pollutant', 'Concentration in Air'],
        ['PM2.5',<?php echo $pm25; ?> ],
        ['PM10', <?php echo $pm10; ?>],
        ['CO', <?php echo $co; ?>],
        ['NO2', <?php echo $no2; ?>],
        ['O3', <?php echo $o3; ?>],
        ['NH3', <?php echo $nh3; ?>],
        ['other',20]
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {'title':'My Average Air Quality', chartArea:{left:20,top:40,width:'100%'}};

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        }
    </script>

    <!-- The Hourly charts -->
    <script type="text/javascript">
        
        google.charts.setOnLoadCallback(drawChart1);
        google.charts.setOnLoadCallback(drawChart2);
        // Hourly
        
        // Draw the chart and set the chart values
        function drawChart1() {
        var data = google.visualization.arrayToDataTable([
                ["Hour", "AQI", { role: "style" } ]
                <?php
                    $qry1="SELECT 	`Date`,`Time`,ROUND(AVG(`AQI`),0)`AQI`
                            FROM `ap`	
                            GROUP BY hour(Time),Date
                            ORDER BY Date DESC,Time DESC LIMIT 24;";
                    if($result1=mysqli_query($db,$qry1))
                    {
                        while($data1=mysqli_fetch_array($result1))
                        {
                            echo ',["'.date("H:i A",strtotime($data1['Time'])).'",'.$data1['AQI'].',"';echo getAqiColor($data1['AQI']);echo '"]';
                            
                        }
                        
                    }
                    else
                    {
                        echo ',["7:00AM", 8.94, "#b87333"],
                        ["8:00AM", 10.49, "silver"],
                        ["9:00AM", 19.30, "gold"],
                        ["10:00AM", 21.45, "color: #e5e4e2"],
                        ["11:00AM",25.33,"color:#123456"]';
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
            title: "Air Quality Index (AQI) Level",
            width: 1500,
            height: 300,
            hAxis : {
                    textPosition :"out",
                    direction:-1,
                    //slantedText :"True",  
                    title:"Time Hourly"},
            bar: {groupWidth: "80%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("poll_hr_colchart"));
        chart.draw(view, options);
        }
        
        // Draw the chart and set the chart values
        function drawChart2() {
        var data = google.visualization.arrayToDataTable([
                ["Hour", "Temprature", { role: "style" } ]
                <?php
                    $qry2="SELECT 	`Date`,`Time`,ROUND(AVG(`TEMPRATURE`),0)`TEMPRATURE`
                            FROM `ap`	
                            GROUP BY hour(Time),Date 
                            ORDER BY Date DESC,Time DESC LIMIT 24;";
                    if($result2=mysqli_query($db,$qry2))
                    {
                        while($data2=mysqli_fetch_array($result2))
                        {
                            echo ',["'.date("H:i A",strtotime($data2['Time'])).'",'.$data2['TEMPRATURE'].',"';echo getAqiColor($data2['TEMPRATURE']);echo '"]';
                        }
                        
                    }
                    else
                    {
                        echo ',["7:00AM", 8.94, "#b87333"],
                        ["8:00AM", 10.49, "silver"],
                        ["9:00AM", 19.30, "gold"],
                        ["10:00AM", 21.45, "color: #e5e4e2"],
                        ["11:00AM",25.33,"color:#123456"]';
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
                title: "TEMPRATURE-Hourly",
                width: 1500,
                height: 300,
                hAxis : {
                    textPosition :"out",
                    direction:-1,
                    //slantedText :"True",  
                    title:"Time Hourly"},
                bar: {groupWidth: "80%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("temp_hr_colchart"));
            chart.draw(view, options);
        }

    </script>

    <!-- The Daily Chart -->
    <script type="text/javascript">
        
        google.charts.setOnLoadCallback(drawChart3);
        google.charts.setOnLoadCallback(drawChart4);
        //DAILY
        
        // Draw the chart and set the chart values
        function drawChart3() {
        var data = google.visualization.arrayToDataTable([
                ["Date", "AQI", { role: "style" } ]
                <?php
                    $qry3="SELECT 	`Date`,ROUND(AVG(`AQI`),0)`AQI`
                            FROM `ap`	
                            GROUP BY Date 
                            ORDER BY Date DESC LIMIT 24;";
                    if($result3=mysqli_query($db,$qry3))
                    {
                        while($data3=mysqli_fetch_array($result3))
                        {
                             echo ',["'.date("j/n",strtotime($data3['Date'])).'",'.$data3['AQI'].',"';echo getAqiColor($data3['AQI']);echo '"]';
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
            title: "Air Quality Index (AQI) Level",
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
        var chart = new google.visualization.ColumnChart(document.getElementById("poll_dly_colchart"));
        chart.draw(view, options);
        }

        // Draw the chart and set the chart values
        function drawChart4() {
        var data = google.visualization.arrayToDataTable([
                ["Date", "Temprature", { role: "style" } ]
                <?php
                    $qry4="SELECT 	`Date`,ROUND(AVG(`TEMPRATURE`),0)`TEMPRATURE`
                            FROM `ap`	
                            GROUP BY Date 
                            ORDER BY Date DESC LIMIT 24;";
                    if($result4=mysqli_query($db,$qry4))
                    {
                        while($data4=mysqli_fetch_array($result4))
                        {
                             echo ',["'.date("j/n",strtotime($data4['Date'])).'",'.$data4['TEMPRATURE'].',"';echo getAqiColor($data4['TEMPRATURE']);echo '"]';
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
                title: "TEMPRATURE-DAILY",
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
            var chart = new google.visualization.ColumnChart(document.getElementById("temp_dly_colchart"));
            chart.draw(view, options);
        }

    </script>

   <!-- Google Maps-->
    <script type="text/javascript">
      google.charts.load("current", {
        "packages":["map"],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        "mapsApiKey": "AIzaSyAfYSvkkaU3EZGBIDCrdc4VBhKmoLuLkCM"
      });
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Lat', 'Long', 'Name'],
          [28.347781, 77.345933, 'Home'],
          [28.347083, 77.344965, 'University'],
          [28.341234, 77.344564, 'Airport'],
          [28.345565, 77.341243, 'Shopping']
        ]);

        var map = new google.visualization.Map(document.getElementById('map_div'));
        map.draw(data, {
          showTooltip: true,
          showInfoWindow: true
        });
      }

    </script>
   
   <!-- Area Maps-->  	
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyAfYSvkkaU3EZGBIDCrdc4VBhKmoLuLkCM'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Provinces',   'AQI'],
          ['Andhra Pradesh', 7],
		  ['Arunachal Pradesh', 2],
		  ['Assam', 6],
		  ['Bihar', 12],
		  ['Chhattisgarh', 77],
		  ['Goa', 15],
		  ['Gujarat', 17],
		  ['Haryana', -8], 
		  ['Himachal Pradesh', 6], 
		  ['Jharkhand', -24],
          ['Karnataka', 34], 
		  ['Kerala', 42], 
		  ['Madhya Pradesh', 3],
		  ['Maharashtra', 54],
          ['Meghalaya', 66], 
		  ['Manipur', 32],
		  ['Nagaland', 54],
		  ['Orissa', 59],
		  ['Punjab', 60],
          ['Rajasthan', 4], 
		  ['Sikkim', 35], 
		  ['Tamil Nadu', 48],
		  ['Uttar Pradesh', -10],
		  ['West Bengal', 70],
		  ['Jammu and Kashmir', 77],
		  ['Delhi', 12],
          ['IN-UT', -12]
        ]);

        var options = {
          region: 'IN', // India
		  domain:'IN',
		  resolution:'provinces',
          colorAxis: {colors: ['#00853f', 'black', '#e31b23']},
          backgroundColor: '#81d4fa',
          datalessRegionColor: '#f8bbd0',
          defaultColor: '#f5f5f5',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('geochart-colors'));
        chart.draw(data, options);
      };
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
