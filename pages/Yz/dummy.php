<!-- THIRD ROW OF BLOCKS -->     
      <div class="row">
      	<div class="col-sm-3 col-lg-3">
	  
	  <!-- BARS CHART - lineandbars.js file -->     
      		<div class="half-unit">
	      		<dtitle>Stock Information</dtitle>
	      		<hr>
	      		<div class="cont">
	      		 <div class="info-aapl">
			        <h4>AAPL</h4>
			        <ul>
			          <li><span class="orange" style="height: 37.5%"></span></li>
			          <li><span class="orange" style="height: 47.5%"></span></li>
			          <li><span class="orange" style="height: 70%"></span></li>
			          <li><span class="orange" style="height: 85%"></span></li>
			          <li><span class="green" style="height: 75%"></span></li>
			          <li><span class="green" style="height: 50%"></span></li>
			          <li><span class="green" style="height: 15%"></span></li>
			        </ul>
			      </div>
			      </div>
      		</div>

	  <!-- TO DO LIST -->     
      		<div class="half-unit">
	      		<dtitle>To Do List</dtitle>
	      		<hr>
	      		<div class="cont">
					<p><bold>13</bold> | Pending Tasks</p>
				</div>
		             <div class="progress">
				        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%;"><span class="sr-only">60% Complete</span>
					        
				        </div>
				     </div>
      		</div>
      	</div>

      	<div class="col-sm-3 col-lg-3">

	  <!-- LIVE VISITORS BLOCK -->     
      		<div class="half-unit">
	      		<dtitle>Live Visitors</dtitle>
	      		<hr>
	      		<div class="cont">
      			<p><bold>388</bold></p>
      			<p><img src="assets/img/up-small.png" alt=""> 412 Max. | <img src="assets/img/down-small.png" alt=""> 89 Min.</p>
	      		</div>
      		</div>
      		
	  <!-- PAGE VIEWS BLOCK -->     
      		<div class="half-unit">
	      		<dtitle>Page Views</dtitle>
	      		<hr>
	      		<div class="cont">
      			<p><bold>145.0K</bold></p>
      			<p><img src="assets/img/up-small.png" alt=""> 23.88%</p>
	      		</div>
      		</div>
      	</div>

      	<div class="col-sm-3 col-lg-3">
	  <!-- TOTAL SUBSCRIBERS BLOCK -->     
      		<div class="half-unit">
	      		<dtitle>Total Subscribers</dtitle>
	      		<hr>
	      		<div class="cont">
      			<p><bold>14.744</bold></p>
      			<p>98 Subscribed Today</p>
	      		</div>
      		</div>
      		
	  <!-- FOLLOWERS BLOCK -->     
      		<div class="half-unit">
	      		<dtitle>Twitter Followers</dtitle>
	      		<hr>
	      		<div class="cont">
      			<p><bold>17.833 Followers</bold></p>
      			<p>@SomeUser</p>
	      		</div>
      		</div>
      	</div>

	  <!-- LATEST NEWS BLOCK -->     
      	<div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
	      		<dtitle>Latest News</dtitle>
	      		<hr>
				<div class="info-user">
					<span aria-hidden="true" class="li_news fs2"></span>
				</div>
				<br>
      			<div class="text">
      				<p><b>Alvarez.is:</b> A beautiful new Dashboard theme has been realised by Carlos Alvarez. Please, visit <a href="http://alvarez.is">Alvarez.is</a> for more details.</p>
      				<p><grey>Last Update: 5 minutes ago.</grey></p>
      			</div>
      		</div>
      	</div>
      </div><!-- /row -->
      
	  <!-- FOURTH ROW OF BLOCKS -->     
	<div class="row">
	
	  <!-- TWITTER WIDGET BLOCK -->     
		<div class="col-sm-3 col-lg-3">
			<div class="dash-unit">
	      		<dtitle>Twitter Widget</dtitle>
	      		<hr>
				<div class="info-user">
					<span aria-hidden="true" class="li_megaphone fs2"></span>
				</div>
				<br>
		 		<div id="jstwitter" class="clearfix">
					<ul id="twitter_update_list"></ul>
				</div>
				<script src="http://twitter.com/javascripts/blogger.js"></script><!-- Script Needed to load the Tweets -->
				<script src="http://api.twitter.com/1/statuses/user_timeline/wrapbootstrap.json?callback=twitterCallback2&amp;count=1"></script>
				<!-- To show your tweets replace "wrapbootstrap", in the line above, with your user. -->
				<div class="text">
				<p><grey>Show your tweets here!</grey></p>
				</div>
			</div>
		</div>

	  <!-- NOTIFICATIONS BLOCK -->     
		<div class="col-sm-3 col-lg-3">
			<div class="dash-unit">
	      		<dtitle>Notifications</dtitle>
	      		<hr>
	      		<div class="info-user">
					<span aria-hidden="true" class="li_bubble fs2"></span>
				</div>
	      		<div class="cont">
	      			<p><button class="btnnew noty" data-noty-options="{&quot;text&quot;:&quot;This is a success notification&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}">Top Right</button></p>
	      			<p><button class="btnnew noty" data-noty-options="{&quot;text&quot;:&quot;This is an informaton notification&quot;,&quot;layout&quot;:&quot;topLeft&quot;,&quot;type&quot;:&quot;information&quot;}">Top Left</button></p>
	      			<p><button class="btnnew noty" data-noty-options="{&quot;text&quot;:&quot;This is an alert notification with fade effect.&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;alert&quot;,&quot;animateOpen&quot;: {&quot;opacity&quot;: &quot;show&quot;}}">Top Center (fade)</button></p>
	      		</div>
			</div>
		</div>

	  <!-- SWITCHES BLOCK -->     
		<div class="col-sm-3 col-lg-3">
			<div class="dash-unit">
	      		<dtitle>Switches</dtitle>
	      		<hr>
	      		<div class="info-user">
					<span aria-hidden="true" class="li_params fs2"></span>
				</div>
				<br>
				<div class="switch">
					<input type="radio" class="switch-input" name="view" value="on" id="on" checked="">
					<label for="on" class="switch-label switch-label-off">On</label>
					<input type="radio" class="switch-input" name="view" value="off" id="off">
					<label for="off" class="switch-label switch-label-on">Off</label>
					<span class="switch-selection"></span>
				</div>
				<div class="switch switch-blue">
					<input type="radio" class="switch-input" name="view2" value="week2" id="week2" checked="">
					<label for="week2" class="switch-label switch-label-off">Week</label>
					<input type="radio" class="switch-input" name="view2" value="month2" id="month2">
					<label for="month2" class="switch-label switch-label-on">Month</label>
					<span class="switch-selection"></span>
				</div>
				
				<div class="switch switch-yellow">
					<input type="radio" class="switch-input" name="view3" value="yes" id="yes" checked="">
					<label for="yes" class="switch-label switch-label-off">Yes</label>
					<input type="radio" class="switch-input" name="view3" value="no" id="no">
					<label for="no" class="switch-label switch-label-on">No</label>
					<span class="switch-selection"></span>
				</div>
			</div>
		</div>

	  <!-- GAUGE CHART BLOCK -->     
		<div class="col-sm-3 col-lg-3">
			<div class="dash-unit">
	      		<dtitle>Gauge Chart</dtitle>
	      		<hr>
	      		<div class="info-user">
					<span aria-hidden="true" class="li_lab fs2"></span>
				</div>
				<canvas id="canvas" width="300" height="300">
			</canvas></div>
		</div>
	
	</div><!--/row -->     
      
 	  <!-- FOURTH ROW OF BLOCKS -->     
		<div class="row">

 	  <!-- ACCORDION BLOCK -->     
			<div class="col-sm-3 col-lg-3">
				<div class="dash-unit">
	      		<dtitle>Accordion</dtitle>
	      		<hr>
					<div class="accordion" id="accordion2">
		                <div class="accordion-group">
		                    <div class="accordion-heading">
		                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
		                        Collapsible Group Item #1
		                        </a>
		                    </div>
		                    <div id="collapseOne" class="accordion-body collapse in">
		                        <div class="accordion-inner">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla iaculis mattis lorem.                        
								</div>
		                    </div>
		                </div>
		
		                <div class="accordion-group">
		                    <div class="accordion-heading">
		                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
		                        Collapsible Group Item #2
		                        </a>
		                    </div>
		                    <div id="collapseTwo" class="accordion-body collapse">
		                        <div class="accordion-inner">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla iaculis mattis lorem.                      
								</div>
		                    </div>
		                </div>
		
		                 <div class="accordion-group">
		                    <div class="accordion-heading">
		                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
		                        Collapsible Group Item #3
		                        </a>
		                    </div>
		                    <div id="collapseThree" class="accordion-body collapse">
		                        <div class="accordion-inner">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla iaculis mattis lorem.                        
		                        </div>
		                    </div>
		                </div>
		            </div><!--/accordion -->
				</div>
			</div>
			
			<div class="col-sm-3 col-lg-3">

 	  		<!-- LAST USER BLOCK -->     
				<div class="half-unit">
	      		<dtitle>Last Registered User</dtitle>
	      		<hr>
	      			<div class="cont2">
	      				<img src="assets/img/user-avatar.jpg" alt="">
	      				<br>
	      				<br>
	      				<p>Paul Smith</p>
	      				<p><bold>Liverpool, England</bold></p>
	      			</div>
				</div>
				
 	  		<!-- MODAL BLOCK -->     
				<div class="half-unit">
	      		<dtitle>Modal</dtitle>
	      		<hr>
		            <div class="cont">
		                <a href="#myModal" role="button" class="btnnew" data-toggle="modal">Example Modal Window</a>
		            </div>
				</div>
			</div>
			<!-- Modal -->
			  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			          <h4 class="modal-title">Modal title</h4>
			        </div>
			        <div class="modal-body">
			          ...
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			          <button type="button" class="btn btn-primary">Save changes</button>
			        </div>
			      </div><!-- /.modal-content -->
			    </div><!-- /.modal-dialog -->
			  </div><!-- /.modal -->
 	  		<!-- FAST CONTACT BLOCK -->     
			<div class="col-sm-3 col-lg-3">
				<div class="dash-unit">
	      		<dtitle>Fast Contact</dtitle>
	      		<hr>
	      		<div class="cont">
                	<form action="#get-in-touch" method="POST" id="contact">
                    	<input type="text" id="contactname" name="contactname" placeholder="Name">
                    	<input type="text" id="email" name="email" placeholder="Email">
                    	<div class="textarea-container"><textarea id="message" name="message" placeholder="Message"></textarea></div>
                    	<input type="submit" id="submit" name="submit" value="Send">
                    </form>
				</div>
				</div>
			</div>

 	  		<!-- INFORMATION BLOCK -->     
			<div class="col-sm-3 col-lg-3">
				<div class="dash-unit">
	      		<dtitle>Block Dashboard</dtitle>
	      		<hr>
	      		<div class="info-user">
					<span aria-hidden="true" class="li_display fs2"></span>
				</div>
				<br>
				<div class="text">
				<p>Block Dashboard created by Basicoh.</p>
				<p>Special Thanks to Highcharts, Linecons and Bootstrap for their amazing tools.</p>
				</div>

				</div>
			</div>

		</div><!--/row -->
     