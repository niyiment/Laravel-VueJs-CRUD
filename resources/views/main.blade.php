<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Laravel VueJS CRUD Sample">
<meta name="author" content="niyiment">
<meta id="csrf-token" name="csrf-token" content="{!! csrf_token() !!}" />
<title>Laravel Vue Employee CRUD</title>
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('css/toastr.min.css')}}" rel="stylesheet">
</head>
<body>
<div class="container" id="app">
    <div class="card">
         <h1 class="text-success">Employee Lists</span></h1>
    <div class="card-header bg-success">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-employee">
             New Employee
        </button>
    </div>
    <!-- card-header -->
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th width="200px">Action</th>
            </tr>
            <tr v-for="employee in employees">
                <td>@{{ employee.name }}</td>
                <td>@{{ employee.email}}</td>
                <td>@{{ employee.phone}}</td>
                <td>    
                    <button class="btn btn-warning" @click.prevent="editEmployee(employee)">Edit</button>
                    <button class="btn btn-danger" @click.prevent="deleteEmployee(employee)">Delete</button>
                </td>
            </tr>
        </table>

         <!-- Create Employee Modal -->
         <div class="modal fade" id="create-employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-white bg-success">
                <h4 class="modal-title" id="myModalLabel">Create Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" v-if="errors.length > 0">
                        <ul>
                            <li v-for="error in errors">@{{ error }}</li>
                        </ul>
                    </div>
                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createEmployee">
                        <div class="form-group">
                            <label id='name' class='control-label'>Name</label>
                            <input type="text" name='name' v-model="employee.name" class='form-control'
                                placeholder='Name'>
                        </div>
                        <div class="form-group">
                            <label id='email' class='control-label'>Email</label>
                            <input type="email" name='email' v-model="employee.email" class='form-control'
                                placeholder='Email'>
                        </div>
                        <div class="form-group">
                            <label id='phone' class='control-label'>Phone</label>
                            <input type="text" name='phone' v-model="employee.phone" class='form-control'
                                placeholder='Phone'>
                        </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

        <!-- Edit Employee Modal -->
        <div class="modal fade" id="edit-employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-success">
            <h4 class="modal-title" id="myModalLabel">Edit Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateEmployee(fill_employee.id)">
                    <div class="form-group">
                        <label id='name' class='control-label'>Name</label>
                        <input type="text" name='name' v-model="fill_employee.name" class='form-control'>
                    </div>
                    <div class="form-group">
                        <label id='email' class='control-label'>Email</label>
                        <input type="email" name='email' v-model="fill_employee.email" class='form-control'>                
                    </div>
                    <div class="form-group">
                        <label id='phone' class='control-label'>Phone</label>
                        <input type="text" name='phone' v-model="fill_employee.phone" class='form-control'>
                    </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/vue.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/axios.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/employee.js')}}"></script>
</body>
</html>