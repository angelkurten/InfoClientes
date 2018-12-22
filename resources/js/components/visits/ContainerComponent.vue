<template>
    <div class="row justify-content-center">
        <div class="col-md-4" v-show="edit_mode">
            <new-visits-component :client="this.client" @new="addVisit"></new-visits-component>
        </div>
        <div v-bind:class="classObject">
            <div class="card">
                <div class="card-header">Visitas  | Cliente: {{ client.name}}
                    <button v-if="!edit_mode" class="btn btn-success btn-x" v-on:click="showHideNewClient()"><i class="material-icons">add</i></button>
                    <button v-else class="btn btn-danger btn-x" v-on:click="showHideNewClient()"><i class="material-icons">visibility_off</i></button>
                </div>
                <div class="card-body">
                    <table class="table table-responsive" style="margin:auto !important;">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Vendedor</th>
                            <th scope="col">Valor neto</th>
                            <th scope="col">Valor visita</th>
                            <th scope="col">Observacion</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <list-visits-component
                                v-for="(visit, index) in visitsC"
                                :key="visit.id"
                                :visit="visit"
                                @editMode="editMode"
                                @update="updateVisit(index, ...arguments)"
                                @delete="deleteVisit(index)"
                        >
                        </list-visits-component>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['client', 'visits'],
        data(){
            return {
                visitsC: this.visits,
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
            console.log('Component mounted.')
        },

        methods:{
            addVisit(client){
                this.visitsC.push(client);
                console.log(this.visits);
            },
            updateVisit(index, client){
                this.visitsC[index] = client;
            },
            deleteVisit(index){
                this.visitsC.splice(index, 1)
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
