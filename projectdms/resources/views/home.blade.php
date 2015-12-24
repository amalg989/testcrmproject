<!DOCTYPE html>
<html>
    <head>
        <title>Test CRM Project</title>
                
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"  />
        <link rel="stylesheet" type="text/css" href="{{ asset('/media/css/animate.css') }}"  />
        <link rel="stylesheet" type="text/css" href="{{ asset('/media/css/bootstrap-datepicker.css') }}"  />
        <link rel="stylesheet" type="text/css" href="{{ asset('/media/css/system.css') }}"  />
    </head>
    <body class="home">
        <div class="container">
            <div class="row">
                <h1 class="home-title">Test CRM Project</h1>
                <button id="logoutBtn" type="button" onclick="window.location.href='/logout'">Log Out</button>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <hr />
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="loader"></div>
                <div class="content col-md-12">
                    <section class="customers-table">
                        <h2><span class="glyphicon glyphicon-user"></span> Customers <span class="addnewlabel label label-default"><a href="javascript:void(0);"  data-toggle="modal" data-target="#newCustomerModal">Add New</a></span></h2>
                        <br>
                        <table id="customerTable" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Registration No.</th>
                                    <th>Address</th>
                                    <th>Website</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->companyName}}</td>
                                    <td>{{$customer->regNo}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->website}}</td>
                                    <td><a id="edit-cusinfo-link" onclick="editCustomer(this)" class="actionlinks" href="javascript:void(0)" title="Edit Customer" data-toggle="modal" data-target="#editCustomerModal"><span class="glyphicon glyphicon-edit"></span></a>
                                        <a id="view-info-link" onclick="viewCustomerInfo(this)" href="javascript:void(0)" title="View Info" data-cusId="{{$customer->id}}" class="actionlinks"><span class="glyphicon glyphicon-exclamation-sign"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            var customercontacts = JSON.parse('{!! $contacts !!}');
                            var customeractivities = JSON.parse('{!! $activities !!}');
                        </script>
                    </section>
                    <section class="customerInfo-table">
                        <a href="javascript:void(0);" id="cus-go-back-link"><span class="glyphicon glyphicon-triangle-left"></span> Go Back</a>
                        <h4 class="clientName">Company Name&#39;s Info</h4>
                        <div class="col-md-6">
                            <section class="contacts-table">
                                <h2><span class="glyphicon glyphicon-phone-alt"></span> Contacts <span class="addnewlabel label label-default"><a href="javascript:void(0);" id="newContactLink"  data-toggle="modal" data-target="#newContactModal">Add New</a></span></h2>
                                <br>
                                <table id="contactsTable" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact No.</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                        <div class="col-md-6">
                            <section class="activities-table">
                                <h2><span class="glyphicon glyphicon-tags"></span> Activities <span class="addnewlabel label label-default"><a href="javascript:void(0);"  data-toggle="modal" data-target="#newActivitiesModal">Add New</a></span></h2>
                                <br>
                                <table id="activitiesTable" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Staff ID</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Outcome</th>
                                            <th>Sales Person&#39;s Name</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                    </section>
                    
                    <div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog" aria-labelledby="newCustomerModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">New Customer</h4>
                                </div>
                                <form action="/newcustomer?session={{$_GET['session']}}" method="post">
                                    <input type="hidden" name="staffId" value="{{$staffId}}"/>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="cus_companyname">Company Name</label>
                                            <input type="text" class="form-control" id="cus_companyname" name="companyname" placeholder="Company Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cus_regno">Registration No.</label>
                                            <input type="text" class="form-control" id="cus_regno" name="regno" placeholder="Registration No." required>
                                        </div>
                                        <div class="form-group">
                                          <label for="cus_address">Address</label>
                                            <input type="text" class="form-control" id="cus_address" name="address" placeholder="Address" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cus_website">Website</label>
                                            <input type="url" class="form-control" id="cus_website" name="website" placeholder="Website" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="newCustomerModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit Customer</h4>
                                </div>
                                <form action="/updatecustomer?session={{$_GET['session']}}" method="post">
                                    <div class="modal-body">
                                            <input type="hidden" id="cus_edit_id" name="id" />
                                             <div class="form-group">
                                                <label for="cus_edit_companyname">Company Name</label>
                                                <input type="text" class="form-control" id="cus_edit_companyname" name="companyname" placeholder="Company Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cus_edit_regno">Registration No.</label>
                                                <input type="text" class="form-control" id="cus_edit_regno" name="regno" placeholder="Registration No." required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cus_edit_address">Address</label>
                                                <input type="text" class="form-control" id="cus_edit_address" name="address" placeholder="Address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cus_edit_website">Website</label>
                                                <input type="url" class="form-control" id="cus_edit_website" name="website" placeholder="Website" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="newContactModal" tabindex="-1" role="dialog" aria-labelledby="newContactModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel">New Contact</h4>
                                </div>
                                <form id="addNewContactForm" action="/newcustomercontact?session={{$_GET['session']}}" method="get" onsubmit="preventDefault()">
                                    <div class="modal-body">
                                        <input type="hidden" name="cusId" />
                                        <div class="form-group">
                                            <label for="cus_contact_name">Name</label>
                                            <input type="text" class="form-control" id="cus_contact_name" name="contactname" placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cus_contact_email">Email</label>
                                            <input type="email" class="form-control" id="cus_contact_email" name="contactemail" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cus_contact_telno">Contact No.</label>
                                            <input type="text" class="form-control" id="cus_contact_telno" name="contacttelno" placeholder="Contact No." required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="closeBtn btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="addNewContact(this)">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editContactModal" tabindex="-1" role="dialog" aria-labelledby="editContactModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel">Edit Contact</h4>
                                </div>
                                <form id="editContactForm" action="/updatecustomercontact?session={{$_GET['session']}}" method="get" onsubmit="preventDefault()">
                                    <div class="modal-body">
                                        <input type="hidden" id="cus_edit_contact_cusid" name="contactcusid" />
                                        <input type="hidden" id="cus_edit_contact_id" name="contactid" />
                                        <div class="form-group">
                                            <label for="cus_edit_contact_name">Name</label>
                                            <input type="text" class="form-control" id="cus_edit_contact_name" name="contactname" placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cus_contact_email">Email</label>
                                            <input type="email" class="form-control" id="cus_edit_contact_email" name="contactemail" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cus_contact_telno">Contact No.</label>
                                            <input type="text" class="form-control" id="cus_edit_contact_telno" name="contacttelno" placeholder="Contact No." required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="closeBtn btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="editContact(this)">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="newActivitiesModal" tabindex="-1" role="dialog" aria-labelledby="newActivitiesModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">New Activity</h4>
                              </div>
                              <div class="modal-body">
                                  <form id="addNewActivityForm" action="/newcustomeractivity?session={{$_GET['session']}}" method="post">
                                      <input type="hidden" name="cusId"/>
                                      <input type="hidden" name="activitystaffId" value="{{$staffId}}"/>
                                      <div class="form-group">
                                          <label for="cus_activity_date">Date</label>
                                          <input type="datetime" class="form-control" id="cus_activity_date" name="activitydate" placeholder="Date" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="cus_activity_type">Activity Type</label>
                                          <input type="text" class="form-control" id="cus_activity_type" name="activitytype" placeholder="Activity Type" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="cus_activity_outcome">Outcome</label>
                                          <input type="text" class="form-control" id="cus_activity_outcome" name="activityoutcome" placeholder="Outcome" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="cus_activity_staff">Sales Person&#39;s Name</label>
                                          <input type="text" class="form-control" id="cus_activity_staff" name="activitystaff" placeholder="Sales Person's Name" value="{{$staffName}}" readonly>
                                      </div>
                                  </form>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="closeBtn btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary" onclick="addNewActivity(this)">Submit</button>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editActivitiesModal" tabindex="-1" role="dialog" aria-labelledby="editActivitiesModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Activity</h4>
                              </div>
                              <div class="modal-body">
                                  <form id="editActivityForm" action="/updatecustomeractivity?session={{$_GET['session']}}" method="post">
                                      <input type="hidden" id="cus_edit_activity_id" name="id"/>
                                      <input type="hidden" id="cus_edit_activity_cusId" name="cusId"/>
                                      <input type="hidden" id="cus_edit_activity_staffId" name="activitystaffId" />
                                      <div class="form-group">
                                          <label for="cus_activity_date">Date</label>
                                          <input type="datetime" class="form-control" id="cus_edit_activity_date" name="activitydate" placeholder="Date" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="cus_activity_type">Activity Type</label>
                                          <input type="text" class="form-control" id="cus_edit_activity_type" name="activitytype" placeholder="Activity Type" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="cus_activity_outcome">Outcome</label>
                                          <input type="text" class="form-control" id="cus_edit_activity_outcome" name="activityoutcome" placeholder="Outcome" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="cus_activity_staff">Sales Person&#39;s Name</label>
                                          <input type="text" class="form-control" id="cus_edit_activity_staff" name="activitystaff" placeholder="Sales Person's Name" value="{{$staffName}}" readonly>
                                      </div>
                                  </form>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="closeBtn btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary" onclick="editActivity(this)">Submit</button>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            &copy; 2015. Designed by <a href="">Amal Gamage</a>. 
        </footer>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="{{ asset('/media/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/media/js/base.js')}}" type="text/javascript"></script>
    </body>
</html>
