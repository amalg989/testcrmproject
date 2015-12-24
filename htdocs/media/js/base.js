var customerTable, contactsTable, activitiesTable;
var selectedCustomerData = new Array();
var selectedCustomerContactData = new Array();

function registerForm(){
    jQuery(".login-section section.login").addClass("animated bounceOut");
    
    setTimeout(function(){
        jQuery(".login-section section.login").hide();
        jQuery(".login-section section.login").removeClass("animated bounceOut");
        jQuery(".login-section section.registration").addClass("animated bounceIn");
        jQuery(".login-section section.registration").show();
    },500);
}

function logInForm(){
    jQuery(".login-section section.registration").addClass("animated bounceOut");
    
    setTimeout(function(){
        jQuery(".login-section section.registration").hide();
        jQuery(".login-section section.registration").removeClass("animated bounceOut");
        jQuery(".login-section section.login").addClass("animated bounceIn");
        jQuery(".login-section section.login").show();
    },500);
}

function editCustomer(ele){
    selectedCustomerData = customerTable.row( $(ele).parent().parent() ).data();
    $("#cus_edit_id").val(selectedCustomerData[0]);
    $("#cus_edit_companyname").val(selectedCustomerData[1]);
    $("#cus_edit_regno").val(selectedCustomerData[2]);
    $("#cus_edit_address").val(selectedCustomerData[3]);
    $("#cus_edit_website").val(selectedCustomerData[4]);
}

function addNewContact(ele){
    
    var selectedCustomerId = selectedCustomerData[0];
    var formData = $("#addNewContactForm").serialize();
    
    if($("#addNewContactForm")[0].checkValidity()){
//        preventDefault();
        
        $.ajax({
            url: $("#addNewContactForm").attr("action"),
            method: "get",
            data: formData,
            success: function(results){
                customercontacts = JSON.parse(results);
                
                var contactList = "";

                $.each(customercontacts, function(index, value){
                    if(parseInt(value.cusId) == parseInt(selectedCustomerId)){
                        contactList += "<tr><td>"+value.id+"</td><td>" + value.name + "</td><td>"+ value.email + "</td><td>"+ value.contactNo + "</td><td><a id='edit-cusinfocontact-link' onclick='editCustomerContact(this)' class='actionlinks' href='javascript:void(0)' title='Edit Customer Contact' data-toggle='modal' data-target='#editContactModal'><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
                    }
                });

                if(contactsTable){
                    contactsTable.destroy();
                }

                $("table#contactsTable tbody").html(contactList);

                contactsTable = $('table#contactsTable').DataTable({
                    "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],
                    "ordering": false,
                    "destroy": true
                });
                
                $("#addNewContactForm").find("input.form-control").val("");
                $(ele).parent().find("button.closeBtn").click();
            }
        });
        
    } else {
        $("#addNewContactForm").append("<input type='submit' value='Submit'/>").find(":submit").hide().click();
    }
}

function editCustomerContact(ele){
    selectedCustomerContactData = contactsTable.row( $(ele).parent().parent() ).data();
    $("#cus_edit_contact_cusid").val(selectedCustomerData[0]);
    $("#cus_edit_contact_id").val(selectedCustomerContactData[0]);
    $("#cus_edit_contact_name").val(selectedCustomerContactData[1]);
    $("#cus_edit_contact_email").val(selectedCustomerContactData[2]);
    $("#cus_edit_contact_telno").val(selectedCustomerContactData[3]);
}

function editContact(ele){
    var selectedCustomerId = selectedCustomerData[0];
    var formData = $("#editContactForm").serialize();
    
    if($("#editContactForm")[0].checkValidity()){
//        preventDefault();
        
        $.ajax({
            url: $("#editContactForm").attr("action"),
            method: "get",
            data: formData,
            success: function(results){
                customercontacts = JSON.parse(results);
                
                var contactList = "";

                $.each(customercontacts, function(index, value){
                    if(parseInt(value.cusId) == parseInt(selectedCustomerId)){
                        contactList += "<tr><td>"+value.id+"</td><td>" + value.name + "</td><td>"+ value.email + "</td><td>"+ value.contactNo + "</td><td><a id='edit-cusinfocontact-link' onclick='editCustomerContact(this)' class='actionlinks' href='javascript:void(0)' title='Edit Customer Contact' data-toggle='modal' data-target='#editContactModal'><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
                    }
                });

                if(contactsTable){
                    contactsTable.destroy();
                }

                $("table#contactsTable tbody").html(contactList);

                contactsTable = $('table#contactsTable').DataTable({
                    "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],
                    "ordering": false,
                    "destroy": true
                });
                
                $("#editContactForm").find("input.form-control").val("");
                $(ele).parent().find("button.closeBtn").click();
            }
        });
        
    } else {
        $("#editContactForm").append("<input type='submit' value='Submit'/>").find(":submit").hide().click();
    }
}

function addNewActivity(ele){
    var selectedCustomerId = selectedCustomerData[0];
    var formData = $("#addNewActivityForm").serialize();
    
    if($("#addNewActivityForm")[0].checkValidity()){
//        preventDefault();
        
        $.ajax({
            url: $("#addNewActivityForm").attr("action"),
            method: "get",
            data: formData,
            success: function(results){
                customeractivities = JSON.parse(results);
                
                var activitiesList = "";
                
                $.each(customeractivities, function(index, value){
                    if(parseInt(value.cusId) == parseInt(selectedCustomerId)){
                        activitiesList += "<tr><td>"+value.activityId+"</td><td>"+value.staffId+"</td><td>" + value.date + "</td><td>"+ value.type + "</td><td>"+ value.outcome + "</td><td>" + value.staffName+"</td><td><a id='edit-cusinfocontact-link' onclick='editCustomerActivity(this)' class='actionlinks' href='javascript:void(0)' title='Edit Customer Activity' data-toggle='modal' data-target='#editActivitiesModal'><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
                    }
                });
                
                if(activitiesTable){
                    activitiesTable.destroy();
                }

                $("table#activitiesTable tbody").html(activitiesList);

                activitiesTable = $('#activitiesTable').DataTable({
                    "columnDefs": [
                        {
                            "targets": [ 0, 1],
                            "visible": false,
                            "searchable": false
                        }
                    ],
                    "ordering": false,
                    "destroy": true
                });
                
                $("#addNewActivityForm").find("input.form-control").val("");
                $(ele).parent().find("button.closeBtn").click();
            }
        });
        
    } else {
        $("#addNewActivityForm").append("<input type='submit' value='Submit'/>").find(":submit").hide().click();
    }
}

function editCustomerActivity(ele){
    selectedCustomerActivityData = activitiesTable.row( $(ele).parent().parent() ).data();
    
    $("#cus_edit_activity_id").val(selectedCustomerActivityData[0]);
    $("#cus_edit_activity_cusid").val(selectedCustomerData[0]);
    $("#cus_edit_activity_staffId").val(selectedCustomerActivityData[1]);
    $("#cus_edit_activity_date").val(selectedCustomerActivityData[2]);
    $("#cus_edit_activity_type").val(selectedCustomerActivityData[3]);
    $("#cus_edit_activity_outcome").val(selectedCustomerActivityData[4]);
}

function editActivity(ele){
    var selectedCustomerId = selectedCustomerData[0];
    var formData = $("#editActivityForm").serialize();
    
    if($("#editActivityForm")[0].checkValidity()){
//        preventDefault();
        
        $.ajax({
            url: $("#editActivityForm").attr("action"),
            method: "get",
            data: formData,
            success: function(results){
                customeractivities = JSON.parse(results);
                
                var activitiesList = "";
                
                $.each(customeractivities, function(index, value){
                    if(parseInt(value.cusId) == parseInt(selectedCustomerId)){
                        activitiesList += "<tr><td>"+value.activityId+"</td><td>"+value.staffId+"</td><td>" + value.date + "</td><td>"+ value.type + "</td><td>"+ value.outcome + "</td><td>" + value.staffName+"</td><td><a id='edit-cusinfocontact-link' onclick='editCustomerActivity(this)' class='actionlinks' href='javascript:void(0)' title='Edit Customer Activity' data-toggle='modal' data-target='#editActivitiesModal'><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
                    }
                });
                
                if(activitiesTable){
                    activitiesTable.destroy();
                }

                $("table#activitiesTable tbody").html(activitiesList);

                activitiesTable = $('#activitiesTable').DataTable({
                    "columnDefs": [
                        {
                            "targets": [ 0, 1],
                            "visible": false,
                            "searchable": false
                        }
                    ],
                    "ordering": false,
                    "destroy": true
                });
                
                $("#editActivityForm").find("input.form-control").val("");
                $(ele).parent().find("button.closeBtn").click();
            }
        });
        
    } else {
        $("#editActivityForm").append("<input type='submit' value='Submit'/>").find(":submit").hide().click();
    }
}

function viewCustomerInfo(ele){
    selectedCustomerData = customerTable.row( $(ele).parent().parent() ).data();
    var selectedCustomerId = selectedCustomerData[0];
    $("H4.clientName").html("<b>" + selectedCustomerData[1] + "&#39;s Info</b>");
    $("input[name='cusId']").val(selectedCustomerId);
    
    var contactList = "";
    var activitiesList = "";
    
    $.each(customercontacts, function(index, value){
        if(parseInt(value.cusId) == parseInt(selectedCustomerId)){
            contactList += "<tr><td>"+value.id+"</td><td>" + value.name + "</td><td>"+ value.email + "</td><td>"+ value.contactNo + "</td><td><a id='edit-cusinfocontact-link' onclick='editCustomerContact(this)' class='actionlinks' href='javascript:void(0)' title='Edit Customer Contact' data-toggle='modal' data-target='#editContactModal'><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
        }
    });
    
    $.each(customeractivities, function(index, value){
        if(parseInt(value.cusId) == parseInt(selectedCustomerId)){
            activitiesList += "<tr><td>"+value.activityId+"</td><td>"+value.staffId+"</td><td>" + value.date + "</td><td>"+ value.type + "</td><td>"+ value.outcome + "</td><td>" + value.staffName+"</td><td><a id='edit-cusinfocontact-link' onclick='editCustomerActivity(this)' class='actionlinks' href='javascript:void(0)' title='Edit Customer Activity' data-toggle='modal' data-target='#editActivitiesModal'><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
        }
    });
    
    $("section.customers-table").addClass("animated fadeOutLeft");
    
    setTimeout(function(){
        $("section.customers-table").hide();
        $("section.customers-table").removeClass("animated fadeOutLeft");
        $("section.customerInfo-table").addClass("animated fadeInLeft");
        $("section.customerInfo-table").show();
        
        if(contactsTable){
            contactsTable.destroy();
        }
        
        if(activitiesTable){
            activitiesTable.destroy();
        }
        
        $("table#contactsTable tbody").html(contactList);
        $("table#activitiesTable tbody").html(activitiesList);
    
        contactsTable = $('table#contactsTable').DataTable({
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ],
            "ordering": false,
            "destroy": true
        });
        
        activitiesTable = $('#activitiesTable').DataTable({
            "columnDefs": [
                {
                    "targets": [ 0, 1],
                    "visible": false,
                    "searchable": false
                }
            ],
            "ordering": false,
            "destroy": true
        });
    }, 500);
}

function viewCustomers(){
    $("section.customerInfo-table").addClass("animated fadeOutLeft");
    
    setTimeout(function(){
        $("section.customerInfo-table").hide();
        $("section.customerInfo-table").removeClass("animated fadeOutLeft");
        $("section.customers-table").addClass("animated fadeInLeft");
        $("section.customers-table").show();
    }, 500);
}

$("#register-link").on('click', function(){
    registerForm();
});

$("#login-link").on('click', function(){
    logInForm();
});

$("#cus-go-back-link").on('click', function(){
    viewCustomers();
});

$("#newContactLink").on('click', function(){
    $("#addNewContactForm").find(":submit").remove();
});

$(document).ready(function() {
    customerTable = $('#customerTable').DataTable({
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],
        "ordering": false,
        "destroy": true
    });
    
    $('input[type=datetime]').datepicker({
        format: 'yyyy-mm-dd'
    });
    
} );