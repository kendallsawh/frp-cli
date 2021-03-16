
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<b><h3 class="modal-title" id="notificationModalLabel">Notice</h3></b>
				

			</div>
			<div class="modal-body">


				<form method="POST" action="{{route('showNotifications')}}" id="notofication_form"  enctype="multipart/form-data">
					<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
					{{ csrf_field() }}
					
					
					
						
						<div class="row" id="checklist">
							<div class="col-sm-12">
								<div class="card-title text-left">
									<!-- <p><h4>Hello {{Auth::user()->name}}, we at the programming team have been working tirelessly to improve your user experience. In so doing we were able to migrate farmer records from the NAMIS database. </h4></p>
									<p><h4>Please be aware, it is only the farmers personal information, you will still need to add the application data for the farmer and upload the required documents. We are currently attempting to retrieve and insert the application data to help lighten any data entry at your county.</h4></p>
									<p><h4>To enter the data select an individual from this <b><a href="{{route('individualList')}}">Link</a></b>  or from the <b>Individual List</b> option under <b>Farmers</b> in the sidebar. A clearly labelled, bright blue button will be available to begin the data entry.</h4></p> -->

									<!-- <p><h4>Hello {{Auth::user()->name}}, the Computer Wizards Department(ICT Department) have done it again! To improve your user experience we were able to migrate parcel data for many of our registered farmers from the NAMIS database. </h4></p>
									<p><h4>Please be aware you will still need to make minor edits such as specific crops and upload the required documents. We are currently attempting to retrieve and insert as much of the data because we care about you.</h4></p>
									<p><h4>To edit the data select an application from this <b><a href="{{route('applicationList')}}">List</a></b>  or from the <b>Application List</b> option under <b>Applications</b> in the sidebar. A green button labeled Edit Parcel will be displayed next to each parcel where you can input additional information.</h4></p>
									<p><h4>We at the Computer Wizard Department thank you for your patience and hope to bring you more computer magic stuff.</h4></p>
									<p><h4>Respectfully, Kendall Sawh</h4></p>
									<p><h4>Head Computer Magic Guy</h4></p> -->
									<!-- <p><h4>Hello {{Auth::user()->name}}, We have made minor updates to help you along. Now you can see which documents are missing for an application and also Clerks can edit applications that were registered in thier County but the parcel holding is Out of County. You can also now Flag an application before it goes any further to rectify issues you have encoutered.</h4></p> -->
									<!-- <p><h4>Major updates have been made to the system on the 27 June 2019.The Out of County features have been applied in full. Applications that are renewals or new which include parcels residing outside of the registering County now require the attention of these outside Counties to verify the application. Any questions can be sent to kendall.sawh@gov.tt</h4></p> -->
									<p><h4>Hello guys, hope youare having a wonderful day, we at the Programming unit made a minor update on the 22nd July 2019. This update pertains to the crop selection list, providing more relevant crops. Any questions can be sent to kendall.sawh@gov.tt</h4></p>
									<p><h4>Respectfully, Kendall Sawh</h4></p>
									<p><h4>IT Analyst/Programmer</h4></p>
								</div>
							</div>
							
						</div>
							
						
						
						            
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-fill btn-default" form="notofication_form">Dont Show Again</button>
				<button type="button" class="btn  btn-success" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>