<template>
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <Button class="btn btn-success mb-5" data-toggle="modal" data-target="#addDeveloper">Create Developer</Button>
            <button class="btn btn-danger ml-2 mb-5" id="deleteAll">Delete All</button>
        </div>

        <!-- display all developers list -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="developersTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Image</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='(developer, index) in developers' :key='index'>
                                <td>{{developer.id}}</td>
                                <td>{{developer.id}}</td>
                                <td><img :src="'/storage/app/'+developer.image" alt="image"></td>
                                <td>{{developer.first_name}}</td>
                                <td>{{developer.last_name}}</td>
                                <td>{{developer.email}}</td>
                                <td>{{developer.phone_no}}</td>
                                <td>{{developer.address}}</td>
                                <td>
                                    <a class="btn text-info" href="#viewUpdateDeveloper" data-toggle="modal" @click="viewDeveloper(developer.id);">View / Edit</a>
                                    <button class="btn text-danger" onclick="confirm('Confirm want to change activation?') || event.stopImmediatePropagation()" @click="deleteDeveloper(developer.id);">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Create Developer Modal -->
        <div class="modal fade" id="addDeveloper">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Create Developer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div>
                            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                        </div>
                        <div class="row mt-5">
                            <div class="col-sm-2"> First Name</div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="add.first_name">
                            </div>
                            <div class="col-sm-2"> Last Name</div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="add.last_name">
                            </div>
                            <div class="col-sm-2"> Email</div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="add.email">
                            </div>
                            <div class="col-sm-2"> Phone No</div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="add.phone_no">
                            </div>
                            <div class="col-sm-2"> Address</div>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" v-model="add.address"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" @click="addDeveloper()">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View/Update Developer Modal -->
        <div class="modal fade" id="viewUpdateDeveloper">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">View/Update Developer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div>
                            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                        </div>
                        <div class="row mt-5">
                            <div class="col-sm-2"> First Name</div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="add.first_name">
                            </div>
                            <div class="col-sm-2"> Last Name</div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="add.last_name">
                            </div>
                            <div class="col-sm-2"> Email</div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="add.email">
                            </div>
                            <div class="col-sm-2"> Phone No</div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="add.phone_no">
                            </div>
                            <div class="col-sm-2"> Address</div>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" v-model="add.address"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" @click="updateDeveloper()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            this.fetchDevelopers();
        },
        data(){
            return {
                developers:{},
                add: {
                    id:"",
                    file:"",
                    first_name: "",
                    last_name: "",
                    email: "",
                    phone_no: "",
                    address: "",
                },
            }
        },
        methods:{
            fetchDevelopers(){
                axios.get('http://localhost:8000/api/developers')
                .then(res => {
                    this.developers = res.data.data;
                    console.log(this.developers);
                }).then(res => {
                   var table = $("#developersTable").DataTable({
                        "order": [[ 0, "desc" ]],
                        "deferRender": true,
                        "columnDefs": [
                            //{ "searchable": false, "targets": 5 },
                            //{ "visible": false, "targets": 4 },
                            {
                                targets: 0,
                                render: function (data, type, row) {
                                    if (type === 'display') {
                                        return '<input type="checkbox" class="editor-active">';
                                    }
                                    return data;
                                },
                                className: "dt-body-center",
                                orderable: false,
                                searchable: false
                            },
                        ],
                    });

                    $('input.editor-active').on('click', function () {
                        console.log('normal change event '); // it is never shown
                        cb = $(this).prop('checked');
                        console.log(data);
                    });
                    
                    
                    // $('#developersTable').on('change', 'tbody input.editor-active', function () {
                    //     console.log('delegated change event'); // it is never shown
                    //     cb = $(this).prop('checked');
                    //     console.log(cb)
                    // });

                    $('#developersTable tbody').on( 'click', 'tr', function () {
                        $(this).toggleClass('selected');
                    } );
                
                    $('#deleteAll').click( function () {
                        //table.rows('.selected').remove().draw( false );
                        var row = table.rows('.selected').data().length;
                        var row1 = table.row(this.closest('tr')).data();
                        //console.log(row1.ID);
                    } );
                }).catch(err => {console.log(err);});
            },
            //Handles a change on the file upload
            handleFileUpload(){
                this.add.file = this.$refs.file.files[0];
            },
            addDeveloper(){
                if( this.add.first_name == '' || this.add.last_name == '' || this.add.email == '' || this.add.phone_no == '' || this.add.address == ''){
                    return alert("Please fill-up all the fields");
                }
                let formData = new FormData();
                formData.append('image', this.add.file);
                formData.append('first_name', this.add.first_name);
                formData.append('last_name', this.add.last_name);
                formData.append('email', this.add.email);
                formData.append('phone_no', this.add.phone_no);
                formData.append('address', this.add.address);
                axios.post('http://localhost:8000/api/developer', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(res => {
                    if(res.status == 201){
                        location.reload();
                    }
                }).catch(error => {console.log(error);});
            },
            viewDeveloper(id){
                axios.get('http://localhost:8000/api/developers/'+id)
                .then(res => {
                    this.add.id = res.data.data.id,
                    this.add.first_name = res.data.data.first_name,
                    this.add.last_name = res.data.data.last_name,
                    this.add.email = res.data.data.email,
                    this.add.phone_no = res.data.data.phone_no,
                    this.add.address = res.data.data.address
                }).catch(error => {console.log(error);});
            },
            updateDeveloper(){
                axios.put('http://localhost:8000/api/developers/' + this.add.id, this.add)
                .then(res => {
                    if(res.status == 200){
                        location.reload();
                    }
                }).catch(err => {console.log(err);});
            },
            deleteDeveloper(id){
                axios.delete('http://localhost:8000/api/developers/'+id)
                .then(res => {
                    location.reload();
                }).catch(err => {console.log(err);});
            }
        }
    }
</script>