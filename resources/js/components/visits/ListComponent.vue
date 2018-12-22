<template>
    <tr>
        <th scope="row">{{visit.id}}</th>
        <td>
            <input v-if="editMode" type="date" class="form-control" v-model="this.visit.visit_at" name="visit_at">
            <span v-else>{{ visit.visit_at }}</span>
        </td>
        <td>
            <select2 v-if="editMode" :options="sellers"  v-model="seller_id">
            </select2>
            <span v-else>{{ visit.seller.name }}</span>
        </td>
        <td>
            <input v-if="editMode" type="text" class="form-control" @change="updateValueVisit" v-model="visit.value_net" name="value_net">
            <span v-else>{{ visit.value_net }}</span>
        </td>
        <td>
            <input v-if="editMode" type="text" class="form-control" readonly v-model="visit.value_visit" name="value_visit">
            <span v-else>{{ visit.value_visit }}</span>
        </td>
        <td>
            <input v-if="editMode" type="text" class="form-control" v-model="visit.observations" name="observations">
            <span v-else>{{ visit.observations }}</span>
        </td>
        <td>
            <button  v-if="!editMode" v-on:click="onClickEdit()" style="display: inline-block" class="btn btn-x btn-info" v-b-tooltip.hover title="Editar visita"><i class="material-icons md-18">edit</i></button>
            <button  v-else v-on:click="onClickUpdate()" style="display: inline-block" class="btn btn-x btn-success" v-b-tooltip.hover title="Guardar cambios"><i class="material-icons md-18">save</i></button>
            <button  v-on:click="onClickDelete()" style="display: inline-block" class="btn btn-x btn-danger" v-b-tooltip.hover title="Eliminar visita"><i class="material-icons md-18">delete</i></button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['visit'],
        data(){
            return {
                sellers:[],
                editMode: false,
                seller_id:'',
            }
        },

        mounted() {
            axios.get('/api/sellers').then((response) => {
                this.sellers = response.data;
            });
            this.seller_id = this.visit.seller.id;
            console.log('Component mounted.')
        },

        methods: {
            onClickEdit(){
                this.editMode = true;
                this.$emit('editMode', !this.editMode)
            },
            onClickDelete(){
                axios.delete('/api/visits/' + this.visit.id).then((response) => {
                    this.$emit('delete');
                });
            },
            onClickUpdate(){
                this.editMode = false;
                const params =  {
                    id: this.visit.id,
                    client_id: this.visit.client.id,
                    visit_at: this.visit.visit_at,
                    seller_id: this.seller_id,
                    value_net: this.visit.value_net,
                    value_visit: this.visit.value_net * (this.visit.client.percentage_visits / 100),
                    observations: this.visit.observations
                };

                axios.put('/api/visits/' + this.visit.id, params).then((response) => {
                    this.$emit('update', response.data);
                });
            },
            updateValueVisit(){
                this.visit.value_visit = this.visit.value_net * (this.visit.client.percentage_visits / 100);
            }
        }

    }
</script>
