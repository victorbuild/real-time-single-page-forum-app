<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>
                <question
                    v-for="question in questions"
                    :key="question.slug"
                    :data="question"
                    ></question>
            </v-flex>
            <v-flex xs4>
              <app-sidebar

              ></app-sidebar>
            </v-flex>

        </v-layout>
    </v-container>
</template>

<script>
import question from './question.vue'
import AppSidebar from './AppSidebar.vue'
export default {
    components:{question,AppSidebar},
    data(){
        return {
            questions:{}
        }
    },
    created(){
        axios.get('/api/question')
        .then(response => this.questions = response.data.data)
        .catch(error => console.log(error.response.data));
    }
}
</script>

<style>

</style>
