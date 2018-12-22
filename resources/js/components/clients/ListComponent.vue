<template>
    <tr>
        <th scope="row">{{client.id}}</th>
        <td>
            <input v-if="editMode" type="text" class="form-control" v-model="client.nit" name="nit">
            <span v-else>{{ client.nit }}</span>
        </td>
        <td>
            <input v-if="editMode" type="text" class="form-control" v-model="client.name" name="name">
            <span v-else>{{ client.name }}</span>
        </td>
        <td>
            <input v-if="editMode" type="text" class="form-control" v-model="client.direction" name="description">
            <span v-else>{{ client.direction }}</span>
        </td>
        <td>
            <input v-if="editMode" type="text" class="form-control" v-model="client.telephone" name="telephone">
            <span v-else>{{ client.telephone }}</span>
        </td>
        <td>
            <select2 v-if="editMode" :options="countries"  v-model="country_id" @input="getStates">
            </select2>
            <span v-else>{{ client.city.state.country.name }}</span>
        </td>
        <td>
            <select2 v-if="editMode" :options="states"  v-model="state_id" @input="getCities">
            </select2>
            <span v-else>{{ client.city.state.name }}</span>
        </td>
        <td>
            <select2 v-if="editMode" :options="cities"  v-model="city_id">
            </select2>
            <span v-else>{{ client.city.name }}</span>
        </td>
        <td>
            <input v-if="editMode" type="text" class="form-control" v-model="client.quota" name="quota">
            <span v-else>{{ client.quota }}</span>
        </td>
        <td>
            <input v-if="editMode" type="text" class="form-control" v-model="client.balance_quota" name="balance_quota">
            <span v-else>{{ client.balance_quota }}</span>
        </td>
        <td>
            <input v-if="editMode" type="number" min="1" max="100" class="form-control" v-model="client.percentage_visits" name="percentage_visits">
            <span v-else>{{ client.percentage_visits }}</span>
        </td>
        <td>
            <a :href="'clients/' + client.id" style="display: inline-block" class="btn btn-x btn-dark" v-b-tooltip.hover title="Ver visitas"><i class="material-icons md-18">directions_bike</i></a>
            <button  v-if="!editMode" v-on:click="onClickEdit()" style="display: inline-block" class="btn btn-x btn-info" v-b-tooltip.hover title="Editar cliente"><i class="material-icons md-18">edit</i></button>
            <button  v-else v-on:click="onClickUpdate()" style="display: inline-block" class="btn btn-x btn-success" v-b-tooltip.hover title="Guardar cambios"><i class="material-icons md-18">save</i></button>
            <button  v-on:click="onClickDelete()" style="display: inline-block" class="btn btn-x btn-danger" v-b-tooltip.hover title="Eliminar cliente"><i class="material-icons md-18">delete</i></button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['client'],
        data(){
            return {
                states:[],
                cities:[],
                editMode: false,
                extraInfo: false,
                country_id: 0,
                state_id:0,
                city_id:0
            }
        },

        mounted() {
            axios.get('/api/countries').then((response) => {
                this.countries = response.data;
            });
            this.country_id = this.client.city.state.country.id;
            this.state_id = this.client.city.state.id;
            this.city_id = this.client.city.id;
            this.getStates();
            this.getCities();
            console.log('Component mounted.')
        },

        methods: {
            onClickEdit(){
                this.editMode = true;
                this.$emit('editMode', !this.editMode)
            },
            onClickDelete(){
                axios.delete('/api/clients/' + this.client.id).then((response) => {
                    this.$emit('delete');
                });
            },
            onClickUpdate(){
                this.editMode = false;
                const params =  {
                    nit: this.client.nit,
                    name: this.client.name,
                    direction: this.client.direction,
                    telephone: this.client.telephone,
                    country_id: this.country_id,
                    quota: this.client.quota,
                    balance_quota: this.client.balance_quota,
                    percentage_visits: this.client.percentage_visits,
                    state_id: this.state_id,
                    city_id: this.city_id,
                };

                axios.put('/api/clients/' + this.client.id, params).then((response) => {
                    this.$emit('update', response.data);
                });
            },
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
        }

    }
</script>
