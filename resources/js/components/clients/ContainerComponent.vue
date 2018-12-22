<template>
    <div class="row justify-content-center">
        <div class="col-md-4" v-show="edit_mode">
            <new-clients-component @new="addClient"></new-clients-component>
        </div>
        <div v-bind:class="classObject">
            <div class="card">
                <div class="card-header">Clientes  |
                    <button v-if="!edit_mode" class="btn btn-success btn-x" v-on:click="showHideNewClient()"><i class="material-icons">add</i></button>
                    <button v-else class="btn btn-danger btn-x" v-on:click="showHideNewClient()"><i class="material-icons">visibility_off</i></button>
                </div>
                <div class="card-body">
                    <table class="table table-responsive" style="margin:auto !important;">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nit</th>
                            <th scope="col">Name</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Pais</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">Cupo</th>
                            <th scope="col">Saldo cupo</th>
                            <th scope="col">Porcentaje visitas</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <list-clients-component
                                    v-for="(client, index) in clients"
                                    :key="client.id"
                                    :client="client"
                                    @editMode="editMode"
                                    @update="updateClient(index, ...arguments)"
                                    @delete="deleteClient(index)"
                            >

                            </list-clients-component>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                clients: [],
                edit_mode: false,
                height: 8,
            }
        },
        computed:{
            classObject: function(){
                return {
                    'col-md-8': this.edit_mode,
                    'col-md-12': !this.edit_mode,
                }
            }
        },

        mounted() {
            axios.get('/api/clients').then((response) => {
                this.clients = response.data;
            });
            console.log('Component mounted.')
        },

        methods:{
            addClient(client){
                this.clients.push(client);
            },
            updateClient(index, client){
                this.clients[index] = client;
            },
            deleteClient(index){
                this.clients.splice(index, 1)
            },
            editMode(status){
                this.edit_mode = status;
            },
            showHideNewClient(){
                if(this.edit_mode) {
                    this.edit_mode = false;
                } else {
                    this.edit_mode = true;
                }
            }
        }
    }
</script>
