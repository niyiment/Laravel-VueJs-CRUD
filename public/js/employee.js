$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

var app = new Vue ({
    el: '#app',
    data: {
        employee: {name:'', email:'', phone:''},
        fill_employee: {name:'',email:'',phone:'',id:''},
        errors: [],
        employees: [],
        update_employee: {}
    },
    mounted(){
        this.getEmployees();
    },    
    methods:{
        getEmployees: function(){
            axios.get('/employees').then(response => {
                this.employees = response.data;
            });              
        },
        reset: function(){
            this.employee = {name:'',email:'',phone:''};
        },
        createEmployee: function(){
            axios.post('/employees',{
                name: this.employee.name,
                email: this.employee.email,
                phone: this.employee.phone,
            })
            .then(response => {
                this.employee = {name:'',email:'',phone:''};
                this.getEmployees();
                $("#create-employee").modal('hide');
                toastr.success('Employee Created Successfully.', 'Success Alert', {timeOut: 5000});
            })
            .catch (error => { 
                this.errors = [];
                if (error.data.errors.name) {
                    this.errors.push(error.data.errors.name[0]);
                }
                if (error.data.errors.email) {
                    this.errors.push(error.data.errors.email[0]);
                }
                if (error.data.errors.phone) {
                    this.errors.push(error.data.errors.phone[0]);
                }
            });
        },
        editEmployee: function(employee){
            this.errrors = [];
            this.fill_employee.id = employee.id;
            this.fill_employee.name = employee.name;
            this.fill_employee.email = employee.email;
            this.fill_employee.phone = employee.phone;
            $("#edit-employee").modal('show');
        },
        updateEmployee: function(id){
            axios.put('/employees/'+id, {
                name: this.fill_employee.name,
                email: this.fill_employee.email,
                phone: this.fill_employee.phone,
                _method: 'PUT',
            })
            .then(response => {
                this.getEmployees();
                this.fill_employee = {name:'',email:'',phone:'',id:''};
                $("#edit-employee").modal('hide');
                toastr.success('Employee Updated Successfully.', 'Success Alert', {timeOut: 5000});
            })
            .catch (error => {    
                console.log(error);
                this.errors = [];
                if (error.data.errors.name) {
                    this.errors.push(error.data.errors.name[0]);
                }
                if (error.data.errors.email) {
                    this.errors.push(error.data.errors.email[0]);
                }
                if (error.data.errors.phone) {
                    this.errors.push(error.data.errors.phone[0]);
                }
            });
        },
        deleteEmployee: function(employee){
            let conf = confirm("Do you ready want to delete this employee?");
            if (conf === true) {
                axios.delete('/employees/'+employee.id)
                .then(response => {
                    this.getEmployees();
                    toastr.success('Employee Deleted Successfully.', 'Success Alert', {timeOut: 5000});
                })
                .catch (error => {  
                    console.log(error);
                });
            }
        },
    }
});