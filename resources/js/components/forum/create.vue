<template>
    <v-container>
        <form @submit.prevent="create">
            <span class="red--text" v-if="errors.title">{{errors.title[0]}}</span>
            <v-text-field
                v-model="form.title"
                label="標題"
                type="text"
                required
                ></v-text-field>

            <span class="red--text" v-if="errors.category_id">{{errors.category_id[0]}}</span>
            <v-autocomplete
                v-model="form.category_id"
                :items="categories"
                item-text="name"
                item-value="id"
                label="Category"
                ></v-autocomplete>

            <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
            <markdown-editor v-model="form.body"></markdown-editor>

            <v-btn
                color="green"
                type="submit"
                :disabled="disable"
            >新增</v-btn>

        </form>
    </v-container>
</template>

<script>
export default {
    data(){
        return {
            form :{
                title:null,
                category_id:null,
                body:null
            },
            categories:{},
            errors:{}
        }
    },
    created(){
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
    },
    computed:{
      disable(){
        return !(this.form.title && this.form.category_id && this.form.body);
      }
    },
    methods:{
        create(){
            axios.post('/api/question',this.form)
            .then(res => this.$router.push(res.data.path))
            .catch(error => this.errors = error.response.data.errors)
        }
    }
}
</script>

<style>

</style>
