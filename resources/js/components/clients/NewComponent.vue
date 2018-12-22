<template>
    <div class="card">
        <div class="card-header">Nuevo cliente</div>
        <div class="card-body">
            <form action="" v-on:submit.prevent="newClient()" class="form form-horizontal">
                <div class="form-group" v-bind:class="{'has-error' : errors.has('nit')}">
                    <label for="nit">Nit:</label>
                    <input type="text" class="form-control" v-validate="'required'"  v-model="nit" name="nit">
                    <div v-show="errors.has('nit')" class="help-block">{{ errors.first('nit') }}</div>
                </div>
                <div class="form-group">
                    <label for="name" v-bind:class="{'has-error' : errors.has('name')}">Nombre</label>
                    <input type="text" class="form-control"  v-model="name" name="name">
                    <div v-show="errors.has('name')" class="help-block">{{ errors.first('name') }}</div>
                </div>
                <div class="form-group">
                    <label for="direction" v-bind:class="{'has-error' : errors.has('direction')}">Direccion</label>
                    <input type="text" class="form-control" v-model="direction" name="direction">
                    <div v-show="errors.has('direction')" class="help-block">{{ errors.first('direction') }}</div>
                </div>
                <div class="form-group">
                    <label for="telephone" v-bind:class="{'has-error' : errors.has('telephone')}">Telefono</label>
                    <input type="text" class="form-control" v-model="telephone" name="telephone">
                    <div v-show="errors.has('telephone')" class="help-block">{{ errors.first('telephone') }}</div>
                </div>
                <div class="form-group">
                    <label for="country_id">Pais</label>
                    <select2 :options="countries"  v-model="country_id" @input="getStates">
                    </select2>
                </div>
                <div class="form-group">
                    <label for="state_id">Estado</label>
                    <select2 :options="states" v-model="state_id" @input="getCities">
                    </select2>
                </div>
                <div class="form-group">
                    <label for="city_id">Ciudad</label>
                    <select2 :options="cities" v-model="city_id">
                    </select2>
                </div>
                <div class="form-group">
                    <label for="quota" v-bind:class="{'has-error' : errors.has('quota')}">Cupo</label>
                    <input type="text" class="form-control" name="quota" v-model="quota">
                    <div v-show="errors.has('quota')" class="help-block">{{ errors.first('quota') }}</div>
                </div>
                <div class="form-group">
                    <label for="balance_quota" v-bind:class="{'has-error' : errors.has('balance_quota')}">Saldo cupo</label>
                    <input type="text" class="form-control"  v-model="balance_quota" name="balance_quota">
                    <div v-show="errors.has('balance_quota')" class="help-block">{{ errors.first('balance_quota') }}</div>
                </div>
                <div class="form-group">
                    <label for="percentage_visits"  v-bind:class="{'has-error' : errors.has('percentage_visits')}">Porcentage visitas</label>
                    <input type="number" min="1" value="1" max="100" class="form-control" v-model="percentage_visits" name="percentage_visits">
                    <div v-show="errors.has('percentage_visits')" class="help-block">{{ errors.first('percentage_visits') }}</div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/countries').then((response) => {
                this.countries = response.data;
            });
            this.country_id = 1;
            this.getStates();
        },

        data(){
            return {
                nit:'',
                name:'',
                direction:'',
                telephone:'',
                country_id: 1,
                quota:0,
                balance_quota:0,
                percentage_visits:0,
                state_id: 1,
                city_id: 1,
                clients: [],
                countries: [],
                states:[],
                cities:[],
            }
        },

        methods: {
            getStates(){
                axios.get('/api/states/' + this.country_id).then((response) => {
                    this.states = response.data;
                });
            },

            getCities(){
                axios.get('/api/cities/' + this.state_id).then((response) => {
                    this.cities = response.data;
                });
            },

            newClient(){
              const params =  {
                  nit: this.nit,
                  name: this.name,
                  direction: this.direction,
                  telephone: this.telephone,
                  quota: this.quota,
                  balance_quota: this.balance_quota,
                  percentage_visits: this.percentage_visits,
                  city_id: this.city_id,
              };

              axios.post('/api/clients', params).then((response) => {
                  this.$emit('new', response.data);
              }).catch((error) => {
                  this.$setErrorsFromResponse(error.response);
              });
            },
        }
    }
</script>
