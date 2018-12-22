<template>
    <div class="card">
        <div class="card-header">Nueva visita</div>
        <div class="card-body">
            <form action="" v-on:submit.prevent="newVisit()" class="form form-horizontal">
                <div class="form-group" v-bind:class="{'has-error' : errors.has('visit_at')}">
                    <label for="visit_at">Fecha visita:</label>
                    <input type="date" class="form-control"   v-model="visit_at" name="visit_at">
                    <div v-show="errors.has('visit_at')" class="help-block">{{ errors.first('visit_at') }}</div>
                </div>
                <div class="form-group">
                    <label for="seller_id">Vendedor</label>
                    <select2 :options="sellers"  v-model="seller_id">
                    </select2>
                </div>
                <div class="form-group">
                    <label for="value_net" v-bind:class="{'has-error' : errors.has('value_net')}">Valor neto</label>
                    <input type="number" class="form-control"  v-model="value_net" name="value_net" @change="updateValueVisit()">
                    <div v-show="errors.has('value_net')" class="help-block">{{ errors.first('value_net') }}</div>
                </div>
                <div class="form-group">
                    <label for="value_visit" v-bind:class="{'has-error' : errors.has('value_visit')}">Valor visita</label>
                    <input type="text" class="form-control" readonly="readonly"  v-model="value_visit" name="value_visit">
                    <div v-show="errors.has('value_visit')" class="help-block">{{ errors.first('value_visit') }}</div>
                </div>
                <div class="form-group">
                    <label for="observations" v-bind:class="{'has-error' : errors.has('observations')}">Observaciones</label>
                    <textarea class="form-control" v-model="observations" name="observations"></textarea>
                    <div v-show="errors.has('observations')" class="help-block">{{ errors.first('observations') }}</div>
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
        props: ['client'],
        mounted() {
            axios.get('/api/sellers').then((response) => {
                this.sellers = response.data;
            });
        },

        data(){
            return {
                sellers: [],
                visit_at:'',
                seller_id: 1,
                value_net:'',
                value_visit:'',
                observations: '',
            }
        },

        methods: {
            newVisit(){
                const params =  {
                    client_id: this.client.id,
                    visit_at: this.visit_at,
                    seller_id: this.seller_id,
                    value_net: this.value_net,
                    value_visit: this.value_net * (this.client.percentage_visits / 100),
                    observations: this.observations
                };
                axios.post('/api/visits', params).then((response) => {
                    this.$emit('new', response.data);
                }).catch((error) => {
                    this.$setErrorsFromResponse(error.response);
                });
            },

            updateValueVisit(){
                this.value_visit = this.value_net * (this.client.percentage_visits / 100);
            }
        }
    }
</script>
