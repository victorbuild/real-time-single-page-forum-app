<template>
  <v-container>
    <v-alert
      v-if="errors"
      :value="true"
      type="error"
    >
      請輸入分類名稱
    </v-alert>
    <v-form @submit.prevent="submit">
      <v-text-field
        v-model="form.name"
        label="分類名稱"
        required
      ></v-text-field>
      <v-btn type="submit" color="pink" :disabled="disable" v-if="editSlug">更新</v-btn>
      <v-btn type="submit" color="teal" :disabled="disable" v-else>新增</v-btn>
    </v-form>
      <v-card>
          <v-toolbar color="indigo" dark dense>
          <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>

        <v-list>
            <div v-for="(category,index) in categories" :key="category.id">
                <v-list-tile>

                <v-list-tile-action>
                    <v-btn icon small @click="edit(index)">
                        <v-icon color="orange">edit</v-icon>
                    </v-btn>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>
                        {{category.name}}
                    </v-list-tile-title>
                </v-list-tile-content>

                <v-list-tile-action>
                    <v-btn icon small @click="destroy(category.slug,index)">
                        <v-icon color="red">delete</v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
            <v-divider></v-divider>
            </div>
        </v-list>
      </v-card>
  </v-container>
</template>

<script>
export default {
  data(){
    return {
      form:{
        name:null
      },
      categories:{},
      editSlug:null,
      errors:null
    }
  },
  created(){

    if(!User.admin()){
      this.$router.push('/forum');
    }
    axios.get('/api/category')
    .then(res => this.categories = res.data.data)
  },
  methods:{
    submit(){
      this.editSlug ? this.update() : this.create();

    },
    create(){
      axios.post('/api/category',this.form)
      .then(res => {
        this.categories.unshift(res.data)
        this.form.name = null
      })
      .catch(error => this.errors = error.response.data.errors)
    },
    update(){
      axios.patch(`/api/category/${this.editSlug}`,this.form)
      .then(res => {
        this.categories.unshift(res.data)
        this.form.name = null
      })
    },
    edit(index){
      this.form.name = this.categories[index].name;
      this.editSlug = this.categories[index].name;
      this.categories.splice(index,1);
    },
    destroy(slug,index){
      axios.delete(`/api/category/${slug}`)
      .then(res => this.categories.splice(index,1))
    }
  },
  computed:{
    disable(){
      return !this.form.name;
    }
  }
}
</script>

<style>

</style>
