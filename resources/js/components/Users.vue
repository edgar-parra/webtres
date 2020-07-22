<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-light">
                    <div class="card-body">
                        <div class="alert fade show" :class="alert.type" v-if="alert.show && !alert.inModal" role="alert">
                            {{ alert.message }}
                            <button type="button" class="close" aria-label="Close" @click="alert.show = false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h1 class="mb-4">
                            Usuarios
                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalCreate">Nuevo</button>
                        </h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NOMBRES</th>
                                    <th><span class="d-none d-sm-block">APELLIDO PATERNO</span></th>
                                    <th><span class="d-none d-md-block">APELLIDO MATERNO</span></th>
                                    <th><span class="d-none d-lg-block">RUT</span></th>
                                    <th><span class="d-none d-xl-block">FECHA DE NACIMIENTO</span></th>
                                    <th><span class="d-none d-xl-block">EMAIL</span></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in users" :key="user.id" v-if="user.id">
                                    <td data-toggle="modal" data-target="#modalShow" @click="show = user">
                                        <img :src="user.picture"   alt="" class="rounded-circle picture" v-if="user.picture">
                                        <img src="img/pictures/default.png" alt="" class="rounded-circle picture" v-else>
                                    </td>
                                    <td class="align-middle">{{ user.names }}</td>
                                    <td><span class="d-none d-sm-block">{{ user.father_surname }}</span></td>
                                    <td><span class="d-none d-md-block">{{ user.mother_surname }}</span></td>
                                    <td><span class="d-none d-lg-block">{{ user.rut }}</span></td>
                                    <td><span class="d-none d-xl-block">{{ user.date_birth | dateFormat }}</span></td>
                                    <td><span class="d-none d-xl-block">{{ user.email }}</span></td>
                                    <td>
                                        <i class="material-icons-outlined text-danger" 
                                            @click="[(del = user) && (del.index = index)]"
                                            data-toggle="modal" data-target="#modalDelete">delete</i>
                                    </td>
                                    <td>
                                        <i class="material-icons-outlined text-primary"
                                            @click="editUser(user, index)"
                                            data-toggle="modal" data-target="#modalEdit">edit</i></td>
                                </tr>
                                <tr v-if="isEmptyListUsers()">
                                    <td colspan="9" class="text-center">No hay usuarios registrados</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Show -->
        <div class="modal fade" id="modalShow">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Detalles del usuario</h2>
                        <button class="close" data-dismiss="modal" @click="clear()">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row justify-content-center">
                            <img :src="show.picture" alt="" class="rounded-circle picture-medium" v-if="show.picture">
                            <img src="img/pictures/default.png" alt="" class="rounded-circle picture-medium" v-else>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <label class="font-weight-bold">Nombres</label>
                                <input type="text" v-model="show.names" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5 offset-sm-1">
                                <label class="font-weight-bold">Apellido paterno</label>
                                <input type="text" v-model="show.father_surname" class="form-control-plaintext" readonly>
                            </div>
                            <div class="form-group col-sm-5" v-if="show.mother_surname">
                                <label class="font-weight-bold">Apellido materno</label>
                                <input type="text" v-model="show.mother_surname" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5 offset-sm-1">
                                <label class="font-weight-bold">RUT</label>
                                <input type="text" v-model="show.rut" class="form-control-plaintext" readonly>
                            </div>
                            <div class="form-group col-sm-5">
                                <label class="font-weight-bold">Fecha de nacimiento</label>
                                <input type="date" v-model="show.date_birth" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" v-model="show.email" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" @click="clear()">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Create -->
        <div class="modal fade" id="modalCreate" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Crear usuario</h2>
                        <button class="close" data-dismiss="modal" @click="clear()">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert fade show" :class="alert.type" v-if="alert.show && alert.inModal" role="alert">
                            {{ alert.message }}
                            <button type="button" class="close" aria-label="Close" @click="alert.show = false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <label class="required">Nombres</label>
                                <input type="text" v-model="create.names" class="form-control" :class="{ 'is-invalid' : errors.names }">
                                <span class="invalid-feedback" role="alert" v-if="errors.names">
                                    <strong>{{ errors.names[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5 offset-sm-1">
                                <label class="required">Apellido paterno</label>
                                <input type="text" v-model="create.father_surname" class="form-control" :class="{ 'is-invalid' : errors.father_surname }">
                                <span class="invalid-feedback" role="alert" v-if="errors.father_surname">
                                    <strong>{{ errors.father_surname[0] }}</strong>
                                </span> 
                            </div>
                            <div class="form-group col-sm-5">
                                <label>Apellido materno</label>
                                <input type="text" v-model="create.mother_surname" class="form-control" :class="{ 'is-invalid' : errors.mother_surname }">
                                <span class="invalid-feedback" role="alert" v-if="errors.mother_surname">
                                    <strong>{{ errors.mother_surname[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5 offset-sm-1">
                                <label class="required">RUT</label>
                                <input type="text" id="createRut" v-model="create.rut" @keydown="isCharRutValid"  @keyup="validateRut('#createRut')" maxlength="10" placeholder="00000000-0" class="form-control" :class="{ 'is-invalid' : errors.rut }">
                                <span class="invalid-feedback" role="alert" v-if="errors.rut">
                                    <strong>{{ errors.rut[0] }}</strong>
                                </span> 
                            </div>
                            <div class="form-group col-sm-5">
                                <label class="required">Fecha de nacimiento</label>
                                <input type="date" v-model="create.date_birth" class="form-control" :class="{ 'is-invalid' : errors.date_birth }">
                                <span class="invalid-feedback" role="alert" v-if="errors.date_birth">
                                    <strong>{{ errors.date_birth[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <label class="required">Email</label>
                                <input type="email" v-model="create.email" class="form-control" :class="{ 'is-invalid' : errors.email }">
                                <span class="invalid-feedback" role="alert" v-if="errors.email">
                                    <strong>{{ errors.email[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <label class="required">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="createPass" v-model="create.password" class="form-control border-right-0" :class="{ 'is-invalid' : errors.password }">
                                    <span class="input-group-append bg-white border-left-0" @click="togglePassword('#createPass')">
                                        <span class="input-group-text bg-transparent">
                                            <i class="material-icons-outlined" v-if="viewPass">visibility</i>
                                            <i class="material-icons-outlined" v-else>visibility_off</i>
                                        </span>
                                    </span>
                                    <span class="invalid-feedback" role="alert" v-if="errors.password">
                                        <strong>{{ errors.password[0] }}</strong>
                                    </span> 
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <button class="btn btn-secondary btn-block" @click="file()">Subir foto de perfil</button>
                                <input type="file" id="picture" ref="picture" class="form-control" :class="{ 'is-invalid' : errors.picture }">
                                <span class="invalid-feedback" role="alert" v-if="errors.picture">
                                    <strong>{{ errors.picture[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <button class="btn btn-primary btn-block" @click="store()">Guardar</button>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" @click="clear()">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Editar usuario</h2>
                        <button class="close" data-dismiss="modal" @click="editUser({}, null, true)">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert fade show" :class="alert.type" v-if="alert.show && alert.inModal" role="alert">
                            {{ alert.message }}
                            <button type="button" class="close" aria-label="Close" @click="alert.show = false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <label class="required">Nombres</label>
                                <input type="text" v-model="edit.names" class="form-control" :class="{ 'is-invalid' : errors.names }">
                                <span class="invalid-feedback" role="alert" v-if="errors.names">
                                    <strong>{{ errors.names[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5 offset-sm-1">
                                <label class="required">Apellido paterno</label>
                                <input type="text" v-model="edit.father_surname" class="form-control" :class="{ 'is-invalid' : errors.father_surname }">
                                <span class="invalid-feedback" role="alert" v-if="errors.father_surname">
                                    <strong>{{ errors.father_surname[0] }}</strong>
                                </span> 
                            </div>
                            <div class="form-group col-sm-5">
                                <label>Apellido materno</label>
                                <input type="text" v-model="edit.mother_surname" class="form-control" :class="{ 'is-invalid' : errors.mother_surname }">
                                <span class="invalid-feedback" role="alert" v-if="errors.mother_surname">
                                    <strong>{{ errors.mother_surname[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5 offset-sm-1">
                                <label class="required">RUT</label>
                                <input type="text" id="editRut" v-model="edit.rut" @keydown="isCharRutValid"  @keyup="validateRut('#editRut')" maxlength="10" placeholder="00000000-0" class="form-control" :class="{ 'is-invalid' : errors.rut }">
                                <span class="invalid-feedback" role="alert" v-if="errors.rut">
                                    <strong>{{ errors.rut[0] }}</strong>
                                </span> 
                            </div>
                            <div class="form-group col-sm-5">
                                <label class="required">Fecha de nacimiento</label>
                                <input type="date" v-model="edit.date_birth" class="form-control" :class="{ 'is-invalid' : errors.date_birth }">
                                <span class="invalid-feedback" role="alert" v-if="errors.date_birth">
                                    <strong>{{ errors.date_birth[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <label class="required">Email</label>
                                <input type="email" v-model="edit.email" class="form-control" :class="{ 'is-invalid' : errors.email }">
                                <span class="invalid-feedback" role="alert" v-if="errors.email">
                                    <strong>{{ errors.email[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <label>Contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="editPass" v-model="edit.password" placeholder="Ingresa una nueva contraseña" class="form-control border-right-0" :class="{ 'is-invalid' : errors.password }">
                                    <span class="input-group-append bg-white border-left-0" @click="togglePassword('#editPass')">
                                        <span class="input-group-text bg-transparent">
                                            <i class="material-icons-outlined" v-if="viewPass">visibility</i>
                                            <i class="material-icons-outlined" v-else>visibility_off</i>
                                        </span>
                                    </span>
                                    <span class="invalid-feedback" role="alert" v-if="errors.password">
                                        <strong>{{ errors.password[0] }}</strong>
                                    </span> 
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <button class="btn btn-secondary btn-block" @click="fileEdit()">Subir foto de perfil</button>
                                <input type="file" id="pictureEdit" ref="pictureEdit" class="form-control" :class="{ 'is-invalid' : errors.picture }">
                                <span class="invalid-feedback" role="alert" v-if="errors.picture">
                                    <strong>{{ errors.picture[0] }}</strong>
                                </span> 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <button class="btn btn-primary btn-block" @click="update()">Actualizar</button>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-10 offset-sm-1">
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" @click="editUser({}, null, true)">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Delete -->
        <div class="modal fade" id="modalDelete" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-4 text-center">
                        <div class="font-weight-bold mb-2">¿Estás seguro que quieres eliminar este usuario?</div>
                        <img :src="del.picture" alt="" class="rounded-circle picture" v-if="del.picture">
                        <img src="img/pictures/default.png" alt="" class="rounded-circle picture" v-else>
                        {{ del.names }}
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            No, volver
                        </button>
                        <button type="button" class="btn btn-primary" @click="destroy()">
                            Si, confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                show: {},
                create: {},
                edit: {},
                del: {},
                alert: {show: false, type: '', message: '', inModal: false},
                errors: [],
                viewPass: false,
                timer: null
            }
        },
        mounted() {
            console.log('Component users mounted.')
        },
        created() {
            this.getUsers();
        },
        methods: {
            getUsers() {
                axios.get('api/users')
                .then(response => {
                    this.users = response.data;
                });
            },
            store() {
                let formData = new FormData();
                if (this.$refs.picture.files[0]) {
                    formData.append('picture', this.$refs.picture.files[0]);
                }
                
                for ( var key in this.create ) {
                    formData.append(key, this.create[key]);
                }
                
                axios.post('api/users', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.users.push(response.data);
                    this.create = {};
                    this.errors = [];
                    $('#picture').val('');
                    this.showAlert('alert-success', 'El usuario fue creado exitosamente', true);
                })
                .catch(error => {
                    let errorCode = error.response.status;
                    switch(errorCode){
                        case 422:
                            this.errors = error.response.data.errors;
                        default:
                            break;
                    }
                });
            },
            editUser(user = {}, index = null, cancel = false) {
                if (!cancel) {
                    this._beforeEditingCache = Object.assign({}, user);
                    this.edit = user;
                    this.edit.index = index;
                }
                else {
                    Object.assign(this.edit, this._beforeEditingCache);
                    this.clear();
                }
            },
            update() {
                let formData = new FormData();
                if (this.$refs.pictureEdit.files[0]) {
                    formData.append('picture', this.$refs.pictureEdit.files[0]);
                }
                
                for ( var key in this.edit ) {
                    if (key != 'picture')
                        formData.append(key, this.edit[key]);
                }

                axios.post('api/users/' + this.edit.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.users[this.edit.index] = response.data;
                    this.errors = [];
                    $('#pictureEdit').val('');
                    this.showAlert('alert-success', 'El usuario fue actualizado exitosamente');
                    $('#modalEdit').modal('hide');
                })
                .catch(error => {
                    let errorCode = error.response.status;
                    switch(errorCode){
                        case 422:
                            this.errors = error.response.data.errors;
                        default:
                            break;
                    }
                });
            },
            destroy() {
                axios.delete('api/users/' + this.del.id)
                .then(response => {
                   this.users[this.del.index] = {};
                   this.del = {};
                   this.showAlert('alert-success', 'El usuario fue eliminado exitosamente');
                   $('#modalDelete').modal('hide');
                });
            },
            file() {
                $('#picture').click();
            },
            fileEdit() {
                $('#pictureEdit').click();
            },
            showAlert(type, message, inModal = false) {
                $('html, body, .modal').animate( { scrollTop : 0 }, 800 );
                this.alert = {show: true, type: type, message: message, inModal: inModal};
            },
            togglePassword(selector) {
                if (this.viewPass) {
                    $(selector).prop('type', 'password');
                }
                else {
                    $(selector).prop('type', 'text');
                }
                this.viewPass = !this.viewPass;
            },
            clear() {
                this.alert.show = false;
                this.create = {};
                this.edit = {};
                this.errors = [];
            },
            isEmptyListUsers() {
                let empty = true;
                for (let i = 0; i < this.users.length; i++) {
                    if (this.users[i].id) {
                        empty = false;
                        break;
                    }
                }
                return empty;
            },
            isCharRutValid(event) {
                let code = event.keyCode;
                if (!((code >= 48 && code <= 57) || (code == 8 || code == 46 || code == 75 || code == 107 || code == 173))) {
                    event.preventDefault();
                }
            },
            validateRut(selector) {
                clearTimeout(this.timer);
                let rut = $(selector).val();
                let url = '';
                if (!rut) {
                    return;
                }
                if (selector == '#createRut') {
                    url = 'api/users/rut/store/validate';
                }
                else {
                    url = 'api/users/rut/update/validate/' + this.edit.id;
                }
			    this.timer = setTimeout(() => {
                    axios.post(url, {'rut': rut})
                    .then(response => {
                        delete this.errors['rut'];
                        $(selector).removeClass('is-invalid');
                        $(selector).addClass('is-valid');
                    })
                    .catch(error => {
                        let errorCode = error.response.status;
                        switch(errorCode){
                            case 422:
                                this.errors = error.response.data.errors;
                            default:
                                break;
                        }
                    })
			    }, 800);
            }
        },
        filters: {
            dateFormat: function (date) {
                return moment(date).format('DD/MM/YYYY');
            }
        }
    }
</script>
